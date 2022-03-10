<?php

namespace App\Http\Controllers\taqneen;

use App\Category;
use App\Contact;
use App\ExpenseCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Media;
use App\ServicePackage;
use App\Subscription;
use App\TaxRate;
use App\TransactionPayment;
use App\User;
use App\Utils\ContactUtil;
use Carbon\Carbon;
use DB;
use Mpdf\Tag\Sub;
use Yajra\DataTables\Facades\DataTables;

class SubscriptionController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            return $this->data();
        }

        return view('taqneen.subscription.index');
    }

    public function data()
    {
        $business_id = request()->session()->get('user.business_id');

        $query = Subscription::where('business_id', $business_id);

        return DataTables::of($query)
            ->addColumn('action', function ($row) {
                return view('taqneen.subscription.actions', compact('row'));
            })
            ->addColumn('supplier_business_name', function ($row) {
                return optional($row->contact)->supplier_business_name;
            })
            ->addColumn('expire_date', function ($row) {
                return $row->expire_date;
            })
            ->addColumn('first_name', function ($row) {
                return optional($row->contact)->first_name;
            })
            ->addColumn('mobile', function ($row) {
                return optional($row->contact)->mobile;
            })
            ->addColumn('mobile', function ($row) {
                return optional($row->contact)->mobile;
            })
            ->editColumn('created_by', function ($row) {
                return optional($row->user)->first_name;
            })
            ->addColumn('services', function ($row) {
                return implode(", ", $row->subscription_lines()->select('*', DB::raw('(select name from categories where categories.id = service_id) as service'))->pluck('service')->toArray());
            })
            ->addColumn('share', function ($row) {
                return view('layouts.partials.share', ["phone" => optional($row->contact)->mobile, "email" => optional($row->contact)->email]);
            })
            ->rawColumns(['action', 'share'])
            ->make(true);
    }


    public function create()
    {
        $business_id = session('business.id');
        $subscription = new Subscription();
        $payment = new TransactionPayment();
        $customers = Contact::where('business_id', $business_id)->onlyCustomers()->get();
        $customerObject = Contact::getObject();
        $services = Category::forDropdown(session('user.business_id'), "service");
        $packages = ServicePackage::where('business_id', $business_id)->get();
        $users = User::allUsersDropdown($business_id);
        $taxs = TaxRate::getObject();
        $expenses = ExpenseCategory::getObject();
        $expensesList = ExpenseCategory::where('business_id', $business_id)->pluck("name", "id")->toArray();
        $disabled = "disabled";
        $subscription->created_by = auth()->user()->id;
        $subscription->contact = new Subscription();
        $status = [
            "waiting" => __('waiting'),
            "processing" => __('processing'),
            "pay_pending" => __('pay_pending'),
            "active" => __('active'),
            "cancel" => __('cancel')
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
        ));
    }

    public function edit($id)
    {
        $business_id = session('business.id');
        $subscription = Subscription::find($id);
        $payment = TransactionPayment::where('transaction_no', $id)->first();
        $customers = Contact::where('business_id', $business_id)->onlyCustomers()->get();
        $customerObject = Contact::getObject();
        $services = Category::forDropdown(session('user.business_id'), "service");
        $packages = ServicePackage::where('business_id', $business_id)->get();
        $users = User::allUsersDropdown($business_id);
        $taxs = TaxRate::getObject();
        $expenses = ExpenseCategory::getObject();
        $expensesList = ExpenseCategory::where('business_id', $business_id)->pluck("name", "id")->toArray();
        $disabled = "disabled";
        $subscription->transaction_date = date('Y-m-d\TH:i', strtotime($subscription->transaction_date));
        $payment->paid_on = date('Y-m-d\TH:i', strtotime($payment->paid_on));


        $status = [
            "waiting" => __('waiting'),
            "processing" => __('processing'),
            "pay_pending" => __('pay_pending'),
            "active" => __('active'),
            "cancel" => __('cancel')
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

        return responseJson(0, __('done'));
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
        try {
            $data = [
                "status" => $request->status,
                "contact_id" => $request->contact_id,
                "created_by" => $request->created_by ? $request->created_by : session('user.id'),
                "tax_id" => $request->tax_id,
                "tax_amount" => $request->tax_amount,
                "custom_field_1" => $request->custom_field_1,  // expenses ids
                "custom_field_2" => $request->custom_field_2,  // expenses amount
                "final_total" => $request->final_total,  // expenses amount
                "transaction_date" => $request->transaction_date,  // expenses amount
                "sub_type" => $request->sub_type,  // expenses amount
                "business_id" => session('business.id'),
            ];

            //dd($request->all());

            // insert transactions
            $resource = Subscription::create($data);

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
                "notes" => $request->notes,
            ]);

            // insert payment 
            DB::table('transaction_payments')->insert([
                "transaction_no" => $resource->id,
                "business_id" => session('business.id'),
                "created_by" => session('user.id'),
                "amount" => $request->final_total,
                "method" => $request->payment['method'],
                "paid_on" => $request->payment['paid_on'],
            ]);

            // insert media
            Media::uploadMedia(session('business.id'), $resource, $request, "file", false, "App\Transaction");

            $output = [
                "success" => 1,
                "msg" => @trans('done')
            ];
        } catch (\Exception $th) {
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];

            dd($output);
        }
        return back()->with('status', $output);
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
                "final_total" => $request->final_total,  // expenses amount
                "transaction_date" => $request->transaction_date,  // expenses amount
                "sub_type" => $request->sub_type,  // expenses amount
                "business_id" => session('business.id'),
            ];

            // get subscription
            $oldResource =  Subscription::find($id);
            $resource = Subscription::find($id);

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
            if ($request->notes)
                DB::table('subscription_notes')->insert([
                    "transaction_id" => $resource->id,
                    "user_id" => session('user.id'),
                    "notes" => $request->notes,
                ]);

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
            }

            // insert payment  
            // remove old payment
            TransactionPayment::where('transaction_no', $id)->delete();

            // insert new
            DB::table('transaction_payments')->insert([
                "transaction_no" => $resource->id,
                "business_id" => session('business.id'),
                "created_by" => session('user.id'),
                "amount" => $request->final_total,
                "method" => $request->payment['method'],
                "paid_on" => $request->payment['paid_on'],
            ]);

            // insert media
            Media::uploadMedia(session('business.id'), $resource, $request, "file", false, "App\Transaction");

            $output = [
                "success" => 1,
                "msg" => @trans('done')
            ];
        } catch (Exception $th) {
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];

            dd($output);
        }
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
}
