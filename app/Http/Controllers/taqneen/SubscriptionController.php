<?php

namespace App\Http\Controllers\taqneen;

use App\Category;
use App\Contact;
use App\ExpenseCategory;
use App\Exports\SubscriptionExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\SubscriptionImport;
use App\Media;
use App\ServicePackage;
use App\Subscription;
use App\TaxRate;
use App\Triger;
use App\TransactionPayment;
use App\User;
use App\Utils\ContactUtil;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables; 

class SubscriptionController extends Controller
{

    public function index()
    { 
        if (request()->ajax()) {
            return $this->data();
        }

        $business_id = session('business.id');
        $services = Category::where("business_id", $business_id)->where('category_type', 'service')->get(); 
          
        $users = User::couriers()->get()->pluck('user_full_name', 'id')->toArray();
        $payment_status = [
            "paid" => __('paid'),
            "not_paid" => __('not_paid')
        ];

        return view('taqneen.subscription.index', compact("services", "payment_status", "users"));
    }

    public function getQuery() {
        $business_id = request()->session()->get('user.business_id');

        $query = Subscription::join(
            "contacts", "contacts.id", "=", "transactions.contact_id"
        )
        ->where('transactions.business_id', $business_id)
        ->where('is_renew', '0');
 

        if (auth()->user()->can(find_or_create_p('subscriptions.own_data', 'subscriptions')) && !auth()->user()->isAdmin()) {
            $query->where('transactions.created_by', auth()->user()->id);
        }


        if (request()->service_id > 0) {
            $ids = DB::table('subscription_lines')
                ->where('service_id', request()->service_id)
                ->select('transaction_id')
                ->distinct()
                ->pluck('transaction_id')->toArray();
            $query->whereIn("transactions.id", $ids);
        }

        if (request()->user_id > 0) {
            $query->where('transactions.created_by', request()->user_id);
        }

        if (request()->subscription_type) {
            if (request()->subscription_type == 'new')
                $query->where('transactions.is_renew', '0');
            else
                $query->where('transactions.is_renew', '1');
        }

        if (request()->payment_status) {
            $query->where('transactions.shipping_custom_field_2', request()->payment_status);
        }

        if (request()->register_date_start && request()->register_date_end) {
            $dates = [
                request()->register_date_start . " 01:00:00",
                request()->register_date_end . " 00:00:00"
            ];
            $query->whereBetween('transactions.shipping_custom_field_1', $dates);
        }

        if (request()->transaction_date_start && request()->transaction_date_end) {
            $dates = [
                request()->transaction_date_start . " 01:00:00",
                request()->transaction_date_end . " 00:00:00"
            ];
            $query->whereBetween('transactions.transaction_date', $dates);
        }

        if (request()->expire_date_start && request()->expire_date_end) {
            $dates = [
                request()->expire_date_start,
                request()->expire_date_end
            ];
            $query->whereBetween('transactions.expire_date', $dates);
        }

        if (request()->payment_date_start && request()->payment_date_end) {
            $dates = [
                request()->payment_date_start . " 01:00:00",
                request()->payment_date_end . " 00:00:00"
            ];
            $ids = DB::table('transaction_payments')
                ->where('business_id', session('business.id'))
                ->whereBetween('paid_on', $dates)
                ->whereNotNull('transaction_id')
                ->select('transaction_id')
                ->distinct()
                ->pluck('transaction_id')->toArray();
            $query->whereIn("transactions.id", $ids);
        }
  

        $query->select(
            "*",
            "transactions.id as id",
            "transactions.created_by as created_by",
            "transactions.business_id as business_id",
        );

        return $query;
    }

    public function data()
    {
        $query = $this->getQuery();
 
        return DataTables::of($query)
            ->addColumn('action', function ($row) { 
                $payment_methods = [
                    "transform_from_taqneen" => __('transform_from_taqneen'),
                    "for_elm" => __('for_elm'),
                    "direct_pay" => __('direct_pay')
                ];
                $payment_status = [
                    "paid" => __('paid'),
                    "not_paid" => __('not_paid')
                ];
                $row->payment = TransactionPayment::where('transaction_id', $row->id)->latest()->first();
                return view('taqneen.subscription.actions', compact('row', 'payment_methods', 'payment_status'));
            })  
            ->editColumn('created_by', function ($row) {
                return optional($row->user)->first_name;
            })
            ->addColumn('services', function ($row) {
                return $row->service_names;
            })
            ->editColumn('is_expire', function ($row) {
                $html2 = "";

                if (!$row->isExpire())
                    $html2 = "<span class='badge w3-green' >" . __("active") . "</span>";
                else  
                    $html2 = "<span class='badge w3-red' >" . __("expired") . "</span>"; 

                return $html2;
            })
            ->addColumn('status', function ($row) {
                $html = "";

                if ($row->isExpire())
                    return "<span class='badge w3-red' >" . __("expired") . "</span>"; 

                if ($row->status == Subscription::$ACTIVE)
                    $html = "<span class='badge w3-green' >" . __(Subscription::$ACTIVE) . "</span>";
                else if ($row->status == Subscription::$CANCEL)
                    $html = "<span class='badge w3-red' >" . __(Subscription::$CANCEL . "_") . "</span>";
                else if ($row->status == Subscription::$PAY_PENDING)
                    $html = "<span class='badge w3-orange' >" . __(Subscription::$PAY_PENDING) . "</span>";
                else if ($row->status == Subscription::$PROCESSING)
                    $html = "<span class='badge w3-indigo' >" . __(Subscription::$PROCESSING) . "</span>";
                else if ($row->status == Subscription::$WAITING)
                    $html = "<span class='badge w3-yellow' >" . __(Subscription::$WAITING) . "</span>";
                else
                    $html = "<span class='badge w3-gray' >-</span>";

                return $html;
            })
            ->editColumn('shipping_custom_field_2', function ($row) {
                $html = "";

                if ($row->shipping_custom_field_2 == "paid")
                    $html = "<span class='badge w3-green' >" . __("paid") . "</span>";
                else
                    $html = "<span class='badge w3-red' >" . __("not_paid") . "</span>";

                return $html;
            })
            ->editColumn('final_total', function ($row) { 
                return number_format($row->final_total, 2);
            })
            ->addColumn('share', function ($row) {
                return view('layouts.partials.share', ["phone" => $row->mobile, "email" => $row->email]);
            })
            ->rawColumns(['action', 'share', 'status', 'shipping_custom_field_2', 'is_expire'])
            ->make(true);
    }


    public function show($id)
    {
        $resource = Subscription::find($id); 
        return view('taqneen.subscription.view', compact("resource"));
    }


    public function print($id)
    {
        $resource = Subscription::where("invoice_token", $id)->first();
        /*if (!$resource)
            return back();

        $data = [
            'resource' => $resource
        ];
        $pdf = PDF::loadView('taqneen.subscription.print', $data);
        return $pdf->stream('document.pdf');
        */
 
        return view('taqneen.subscription.print', compact("resource"));
    }

    public function create()
    {
        $business_id = session('business.id');
        $subscription = new Subscription();
        $payment = new TransactionPayment();
        $customers = Contact::where('business_id', $business_id)
            ->onlyCustomers()
            ->where(function ($query) {
                if (auth()->user()->can(find_or_create_p('customers.own_data', 'customers')) && !auth()->user()->isAdmin()) {
                    $query->onlyMe();
                } 
            })
            ->get();
        $customerObject = Contact::getObject();
        $services = Category::forDropdown(session('user.business_id'), "service");
        $packages = ServicePackage::where('business_id', $business_id)->get();
        $users = User::couriers()->where('user_type', 'user')->pluck('first_name', 'id')->toArray();
        $taxs = TaxRate::getObject();
        $expenses = ExpenseCategory::getObject();
        $expensesList = ExpenseCategory::where('business_id', $business_id)->pluck("name", "id")->toArray();
        //$disabled = '';//auth()->user()->can(find_or_create_p('subscription.edit_courier')) ? "" : "disabled";
        $disabled = auth()->user()->can(find_or_create_p('subscription.edit_courier')) ? "" : "disabled";
        $editCourier = auth()->user()->can(find_or_create_p('subscription.edit_courier')) ? "" : "disabled";
        $subscription->created_by = auth()->user()->id;
        $subscription->contact = new Subscription();
        $roles = Role::where('business_id', session('business.id'))
            ->where(function ($query) {
                if (!auth()->user()->isAdmin()) {
                    $query->where('name', 'customer#' . session('business.id'));
                }
            })
            ->pluck('name', 'name')
            ->all();
        $status = [
            "waiting" => __('waiting'),
            "processing" => __('processing'),
            "pay_pending" => __('pay_pending'),
            "active" => __('active'),
            "cancel" => __('cancel_')
        ];
        $paper_status = [
            "received" => __('received'),
            "not_received" => __('not_received')
        ];
        $payment_methods = [
            "transform_from_taqneen" => __('transform_from_taqneen'),
            "for_elm" => __('for_elm'),
            "direct_pay" => __('direct_pay')
        ];
        $payment_status = [
            "paid" => __('paid'),
            "not_paid" => __('not_paid')
        ];
        $walk_in_customer = (new ContactUtil())->getWalkInCustomer($business_id);
        $subscription->transaction_date = date('Y-m-d\TH:i');
        $subscription->shipping_custom_field_1 = date('Y-m-d\TH:i');
        $payment->paid_on = date('Y-m-d\TH:i');

        return view('taqneen.subscription.form', compact(
            "subscription",
            "status",
            "users",
            "walk_in_customer",
            "customers",
            "disabled",
            "services",
            "packages",
            "taxs",
            "expenses",
            "expensesList",
            "payment",
            "payment_methods",
            "paper_status",
            "customerObject",
            "payment_status",
            "roles",
            "editCourier",
        ));
    }

    public function edit($id)
    {
        $business_id = session('business.id');
        $subscription = Subscription::find($id);
        $payment = TransactionPayment::where('transaction_id', $id)->first();
        $payment = ($payment)? $payment : new TransactionPayment();
        $customers = Contact::where('business_id', $business_id)
            ->onlyCustomers()
            ->where(function ($query) {
                if (auth()->user()->can(find_or_create_p('customers.own_data', 'customers')) && !auth()->user()->isAdmin()) {
                    $query->onlyMe();
                } 
            })
            ->get();
        $customerObject = Contact::getObject();
        $services = Category::forDropdown(session('user.business_id'), "service");
        $packages = ServicePackage::where('business_id', $business_id)->get();
        $users = User::couriers()->where('user_type', 'user')->pluck('first_name', 'id')->toArray();
        $taxs = TaxRate::getObject();
        $expenses = ExpenseCategory::getObject();
        $expensesList = ExpenseCategory::where('business_id', $business_id)->pluck("name", "id")->toArray();
        $disabled = auth()->user()->can(find_or_create_p('subscription.edit_courier')) ? "" : "disabled";
        $subscription->transaction_date = date('Y-m-d\TH:i', strtotime($subscription->transaction_date));
        $payment->paid_on = date('Y-m-d\TH:i', strtotime($payment->paid_on));

        $roles = Role::where('business_id', session('business.id'))
            ->where(function ($query) {
                if (!auth()->user()->isAdmin()) {
                    $query->where('name', 'customer#' . session('business.id'));
                }
            })
            ->pluck('name', 'name')
            ->all();


        $status = [
            "waiting" => __('waiting'),
            "processing" => __('processing'),
            "pay_pending" => __('pay_pending'),
            "active" => __('active'),
            "cancel" => __('cancel_')
        ];
        $paper_status = [
            "received" => __('received'),
            "not_received" => __('not_received')
        ];
        $payment_methods = [
            "transform_from_taqneen" => __('transform_from_taqneen'),
            "for_elm" => __('for_elm'),
            "direct_pay" => __('direct_pay')
        ];
        $payment_status = [
            "paid" => __('paid'),
            "not_paid" => __('not_paid')
        ];
        $walk_in_customer = (new ContactUtil())->getWalkInCustomer($business_id);

        return view('taqneen.subscription.form', compact(
            "subscription",
            "status",
            "users",
            "walk_in_customer",
            "customers",
            "disabled",
            "services",
            "packages",
            "taxs",
            "expenses",
            "expensesList",
            "payment",
            "payment_methods",
            "paper_status",
            "customerObject",
            "payment_status",
            "roles",
        ));
    }

    public function addNote(Request $request, $id)
    {
        // insert lines
        if ($request->notes)
            DB::table('subscription_notes')->insert([
                "transaction_id" => $id,
                "user_id" => session('user.id'),
                "notes" => $request->notes,
            ]);

        // fire renew triger
        Triger::fire(Triger::$ADD_SUBSCRIPTION_NOTE, $id);
        return responseJson(1, __('done'));
    }

    public function renew(Request $request, $id)
    {
        $resource = Subscription::find($id);
        $resourceData = $resource->toArray();
        unset($resourceData['token']);
        // copy 
        $newSubscription = Subscription::create($resourceData);
        $newSubscription = $newSubscription->refresh();
        $newSubscription->custom_field_4 = $request->custom_field_4;
        $newSubscription->shipping_custom_field_2 = $request->shipping_custom_field_2;
        $newSubscription->status = Subscription::$ACTIVE; 
        /*$newSubscription->created_by = session('user.id');*/
        if ($resource->isExpire()) {
            $newSubscription->transaction_date = $request->pay_date;  
            $date = Carbon::createFromFormat("Y-m-d H:i:s", $newSubscription->transaction_date); 
            dd($date);
            $newSubscription->expire_date = $date->addYear()->format('Y-m-d');
        }

        if (!$resource->isExpire()) {
            $transdate = $resource->expire_date;
            $date = Carbon::createFromFormat("Y-m-d", $transdate); 
            $newSubscription->expire_date = $date->addYear()->format('Y-m-d');
        }

        $newSubscription->update();

        // copy all subscription lines
        foreach ($resource->subscription_lines()->get() as $item) {
            DB::table('subscription_lines')->insert([
                "transaction_id" => $newSubscription->id,
                "service_id" => $item->service_id,
                "package_id" => $item->package_id,
                "total" => $item->total
            ]);
        }

        // copy all subscription notes
        foreach ($resource->subscription_notes()->get() as $item) {
            DB::table('subscription_notes')->insert([
                "transaction_id" => $newSubscription->id,
                "user_id" => session('user.id'),
                "notes" => $item->notes,
            ]);
        }

        // upload transform photo
        if ($request->hasFile('custom_field_3')) {
            $file = Storage::put("/subscriptions", $request->file('custom_field_3'));
            $newSubscription->custom_field_3 = $file;
            $newSubscription->update();
        }

        // copy payment
        $payment = DB::table('transaction_payments')->where('transaction_id', $resource->id)->first();
        DB::table('transaction_payments')->insert([
            "transaction_id" => $newSubscription->id,
            "business_id" => session('business.id'),
            "created_by" => session('user.id'),
            "amount" => $newSubscription->final_total,
            "method" => $request->method,
            "paid_on" => $request->pay_date,
        ]);

        $resource = Subscription::find($id);
        $resource->update([
            "is_renew" => '1',
            'renew_date' => date('Y-m-d')
        ]);
        $resource->is_renew = '1';
        $resource->renew_date = date('Y-m-d');
        $resource->update();

        // delete old subscription
        $resource->delete();

        // fire renew triger
        Triger::fire(Triger::$RENEW_SUBSCRIPTION, $newSubscription->id);
        return responseJson(1, __('done'));
    }

    public function save(Request $request)
    {
        if ($request->id > 0) {
            return $this->update($request, $request->id);
        } else
            return $this->store($request);
    }

    public function store(Request $request)
    {
        $resource = null;

        if (!$request->subscription_lines) {
            $output = [
                "success" => 0,
                "msg" => __('please_select_at_least_on_service')
            ];

            return responseJson($output['success'], $output['msg']); 
            //return redirect("/subscriptions/" . optional($resource)->id)->with('status', $output);
        }

        try {
            $data = [
                "status" => $request->status,
                "contact_id" => $request->contact_id,
                "created_by" => $request->created_by ? $request->created_by : session('user.id'),
                "tax_id" => $request->tax_id,
                "tax_amount" => $request->tax_amount,
                "custom_field_1" => $request->custom_field_1,  // expenses ids
                "custom_field_2" => $request->custom_field_2,  // expenses amount
                "custom_field_4" => $request->custom_field_4,  // expenses amount
                "shipping_custom_field_1" => $request->shipping_custom_field_1,  // register date
                "shipping_custom_field_2" => $request->shipping_custom_field_2,  // payment status
                "final_total" => $request->final_total,  // expenses amount
                "transaction_date" => $request->transaction_date,  // expenses amount
                "sub_type" => $request->sub_type,  // expenses amount
                "business_id" => session('business.id'),
            ];

            //dd($request->all());

            // insert transactions
            $resource = Subscription::create($data);
            $resource = $resource->refresh();
            $resource->expire_date = $resource->getExpireDate();
            $resource->update();

            
            // insert subscription lines
            foreach ($request->subscription_lines as $item) {
                DB::table('subscription_lines')->insert([
                    "transaction_id" => $resource->id,
                    "service_id" => $item['service_id'],
                    "package_id" => $item['package_id'],
                    "total" => $item['total']
                ]);
            }

            // insert lines
            DB::table('subscription_notes')->insert([
                "transaction_id" => $resource->id,
                "user_id" => session('user.id'),
                "notes" => $request->notes
            ]);

            // insert payment 
            DB::table('transaction_payments')->insert([
                "transaction_id" => $resource->id,
                "transaction_no" => $resource->id,
                "business_id" => session('business.id'),
                "created_by" => session('user.id'),
                "amount" => $request->final_total,
                "method" => $request->payment['method'],
                "paid_on" => $request->payment['paid_on'],
            ]);

            // insert media
            Media::uploadMedia(session('business.id'), $resource, $request, "file", false, "App\Transaction");


            // upload transform photo
            if ($request->hasFile('custom_field_3')) {
                $file = Storage::put("/subscriptions", $request->file('custom_field_3'));
                $resource->custom_field_3 = $file;
                $resource->update();
            }

            // create token 
            $resource->getTokenAttribute();


            // fire new subscription triger
            Triger::fire(Triger::$NEW_SUBSCRIPTION, $resource->id);

            $output = [
                "success" => 1,
                "msg" => @trans('done')
            ];
        } catch (\Exception $th) {
            $output = [
                "success" => 0,
                "msg" => __('fill_all_required_data')
            ];

           // dd($th->getMessage());
        }

        return responseJson($output['success'], $output['msg']); 
        //return redirect("/subscriptions/" . optional($resource)->id)->with('status', $output);
        //return back()->with('status', $output);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = [
                "status" => $request->status,
                "contact_id" => $request->contact_id,
                "created_by" => $request->created_by ? $request->created_by : session('user.id'),
                "tax_id" => $request->tax_id,
                "tax_amount" => $request->tax_amount,
                "custom_field_1" => $request->custom_field_1,  // expenses ids
                "custom_field_2" => $request->custom_field_2,  // expenses amount
                "custom_field_4" => $request->custom_field_4,  // transform number
                "shipping_custom_field_1" => $request->shipping_custom_field_1,  // register date
                "shipping_custom_field_2" => $request->shipping_custom_field_2,  // payment status
                "final_total" => $request->final_total,  // expenses amount
                "transaction_date" => $request->transaction_date,  // expenses amount
                "sub_type" => $request->sub_type,  // expenses amount
                "business_id" => session('business.id'),
            ];

            // get subscription
            $oldResource =  Subscription::find($id);
            $resource = Subscription::find($id);
            $data['expire_date'] = $resource->getExpireDate();

            // insert transactions
            $resource->update($data);

            // insert subscription lines
            foreach ($request->subscription_lines as $item) {
                // remove old
                $resource->subscription_lines()->delete();

                DB::table('subscription_lines')->insert([
                    "transaction_id" => $resource->id,
                    "service_id" => $item['service_id'],
                    "package_id" => $item['package_id'],
                    "total" => $item['total']
                ]);
            }

            // insert lines
            if ($request->notes) {
                DB::table('subscription_notes')->insert([
                    "transaction_id" => $resource->id,
                    "user_id" => session('user.id'),
                    "notes" => $request->notes,
                ]);
                
                // fire add node triger
                Triger::fire(Triger::$ADD_SUBSCRIPTION_NOTE, $id);
            }

            // edit log
            if ($oldResource->status != $resource->status) {
                $msg = __('change status of subscription from {old} to {new}');
                $msg = str_replace("{old}", $oldResource->status, $msg);
                $msg = str_replace("{new}", $resource->status, $msg);

                DB::table('subscription_notes')->insert([
                    "transaction_id" => $resource->id,
                    "user_id" => session('user.id'),
                    "notes" => $msg,
                ]);

                // fire renew triger
                Triger::fire(Triger::$CHANGE_SUBSCRIPTION_STATUS, $resource->id);
            }

            // insert payment  
            // remove old payment
            TransactionPayment::where('transaction_id', $id)->delete();

            // insert new
            DB::table('transaction_payments')->insert([
                "transaction_id" => $resource->id,
                "business_id" => session('business.id'),
                "created_by" => session('user.id'),
                "amount" => $request->final_total,
                "method" => $request->payment['method'],
                "paid_on" => $request->payment['paid_on'],
            ]);

            // insert media
            Media::uploadMedia(session('business.id'), $resource, $request, "file", false, "App\Transaction");

            // upload transform photo
            if ($request->hasFile('custom_field_3')) {
                $file = Storage::put("/subscriptions", $request->file('custom_field_3'));
                $resource->custom_field_3 = $file;
                $resource->update();
            }

            $output = [
                "success" => 1,
                "msg" => @trans('done')
            ];
        } catch (Exception $th) {
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];
 
        }
        return responseJson($output['success'], $output['msg']); 
        return back()->with('status', $output);
    }

    public function destroy($id)
    {
        try {
            $Subscription = Subscription::find($id);
            $Subscription->delete();

            $output = [
                "success" => 1,
                "msg" => @trans('delete successfull')
            ];
        } catch (\Exception $th) {
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];
        }

        return $output;
        return back()->with('status', $output);
    }


    public function customerApi(Request $request)
    {
        // dd($request->all());
        $contact = null;

        try {
            $data = [
                "supplier_business_name" => $request->supplier_business_name,
                "custom_field1" => $request->custom_field1,
                "mobile" => $request->mobile,
                "email" => $request->email,
                "city" => $request->city,
                "state" => $request->state,
                "address_line_1" => $request->address_line_1,
                "address_line_2" => $request->address_line_2,
                "zip_code" => $request->zip_code,
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "name" => $request->first_name . ' ' . $request->last_name,
                "business_id" => session('business.id'),
                "created_by" => session('user.id'),
                "type" => 'customer',
            ];
            $contact = Contact::create($data);
            (new CustomerController())->createOrUpdateUser($contact, $request);

            $output = [
                "success" => 1,
                "msg" => __('done')
            ];
        } catch (\Exception $th) {
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];
        }

        return responseJson($output['success'], $output['msg'],  $contact->fresh());
    }

    public function deleteMedia($id)
    {
        try {
            $media = DB::table('media')->find($id);
            $path = public_path("/uploads/media/" . $media->file_name);

            if (file_exists($path)) {
                unlink($path);
            }

            DB::table('media')->where('id', $id)->delete();
        } catch (\Exception $th) {
            //throw $th;
        }

        $output = [
            "success" => 1,
            "msg" => __('done')
        ];

        return $output;
    }

    public function subscriptionDownload()
    {
        $files = Storage::disk('public_uploads_files')->getAdapter()->applyPathPrefix('import_subscription_template.xlsx');
        return  response()->download($files);
    }

    public function subscriptionImportFile(Request $request)
    {


        //return redirect('/customers');  

        try {
            if ($request->hasFile('import_file')) {
                $import_file = $request->file('import_file');
            }
            Excel::import(new SubscriptionImport, $import_file);

            $output = [
                "success" => 1,
                "msg" => __('done')
            ];
        } catch (Exception $th) {
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];
        }
        //dd($output);

        return back()->with('status', $output);;
    }

    public function export() { 
        return Excel::download(new SubscriptionExport, 'subscriptions.xlsx');
    }
}
