<?php

namespace App\Http\Controllers\taqneen;

use App\Category;
use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subscription;
use App\Transaction;
use App\User;
use DB;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function services()
    {
        $query = Category::join(
            'taqneen_package',
            'taqneen_package.service_id',
            '=',
            'categories.id'
        )->select(
            '*',
            'taqneen_package.name as package_name',
            'categories.name as service_name',
            'taqneen_package.type as service_type',
            DB::raw('(select sum(final_total) from transactions where transactions.id in (select transaction_id from subscription_lines where subscription_lines.package_id = taqneen_package.id)) as subscription_total'),
            DB::raw('(select sum(final_total) from transactions where is_renew != 1 and transactions.id in (select transaction_id from subscription_lines where subscription_lines.package_id = taqneen_package.id)) as subscription_new_total'),
            DB::raw('(select sum(final_total) from transactions where is_renew = 1 and  transactions.id in (select transaction_id from subscription_lines where subscription_lines.package_id = taqneen_package.id)) as subscription_renew_total'),
        )
            ->where('category_type', 'service')
            ->where('categories.business_id', session('business.id'))
            ->where('categories.parent_id', '0')
            ->latest('categories.created_at');

        if (request()->service_id > 0) {
            $query->where('categories.id', request()->service_id);
        }

        if (request()->type) {
            $query->where('taqneen_package.type', request()->type);
        }

        $resources = $query->get();
        $services = Category::where('business_id', session('business.id'))->where('category_type', 'service')->get();

        return view('taqneen.reports.services_report', compact('resources', 'services'));
    }

    public function salesComissions()
    {
        $where = "";

        


        $query = User::select(
            '*',
            //DB::raw('(select sum(final_total) from transactions where is_renew=0 and transactions.business_id = users.business_id) as subscription_new_total'),
            //DB::raw('(select sum(final_total) from transactions where is_renew=1 and renew_date > expire_date and transactions.business_id = users.business_id) as subscription_renew_after_expire_total'),
            //DB::raw('(select sum(final_total) from transactions where is_renew=1 and renew_date < expire_date and transactions.business_id = users.business_id) as subscription_renew_before_expire_total'),
            //DB::raw('(select sum(final_total - tax_amount) from transactions where transactions.business_id = users.business_id) as subscription_before_tax_total'),
            //DB::raw('(select sum(final_total) from transactions where transactions.business_id = users.business_id) as subscription_after_tax_total'),
            DB::raw('(select count(id) from contacts as opport where opport.converted_by = users.id) as opportunity_count'),
        )

        /*$query = User::query()->join(
            "transactions", "transactions.created_by", "=", "users.id"
        )*/
        ->where('business_id', session('business.id'));

        if (request()->user_id > 0) {
            $query->where('users.id', request()->user_id);
        } 


        $resources = $query->get();

        //dd($opportunities->toArray());
        $ops = Contact::where('business_id', session('business.id'))->where('type', 'opportunity')->get();
        $services = Category::where('business_id', session('business.id'))->where('category_type', 'service')->get();
        $users = User::forDropdown(session('business_id'));

        return view('taqneen.reports.sales_commision_reportes', compact('resources', 'services', 'users'));
    }


    public function subscriptions()
    {
        if (request()->ajax()) {
            return $this->dataOfSubscription();
        }

        $business_id = session('business.id');
        $services = Category::where("business_id", $business_id)->where('category_type', 'service')->get();

        $expire_date = date('Y-m-d', strtotime(date('Y-m-d'). ' + 31 days'));
        $data = [
            'subscription_total' => Transaction::where('business_id', session('business.id'))->sum('final_total'),
            'subscription_expire_total' => Transaction::where('business_id', session('business.id'))->where('is_expire', '1')->sum('final_total'),
            'subscription_active_total' => Transaction::where('business_id', session('business.id'))->where('is_expire', '0')->sum('final_total'),
            'subscription_will_expire_total' => Transaction::where('business_id', session('business.id'))->where('expire_date', '<=', $expire_date)->sum('final_total'),
            'chart' => Transaction::where('business_id', session('business.id'))->pluck('transaction_date', 'final_total')->toArray(),
        ];
        return view('taqneen.reports.subscription', compact("services", "data"));
    }

    public function dataOfSubscription()
    {
        $business_id = request()->session()->get('user.business_id');

        $query = Subscription::where('business_id', $business_id);

        if (request()->service_id > 0) {
            $ids = DB::table('subscription_lines')
                ->where('service_id', request()->service_id)
                ->select('transaction_id')
                ->distinct()
                ->pluck('transaction_id')->toArray();
            $query->whereIn("id", $ids);
        }

        if (request()->subscription_type) {
            if (request()->subscription_type == 'new')
                $query->where('is_renew', '0');
            else
                $query->where('is_renew', '1');
        }

        if (request()->transaction_date_start && request()->transaction_date_end) {
            $dates = [
                request()->transaction_date_start . " 01:00:00",
                request()->transaction_date_end . " 00:00:00"
            ];
            $query->whereBetween('transaction_date', $dates);
        }

        if (request()->expire_date_start && request()->expire_date_end) {
            $dates = [
                request()->expire_date_start,
                request()->expire_date_end
            ];
            $query->whereBetween('expire_date', $dates);
        }

        if (request()->payment_date_start && request()->payment_date_end) {
            $dates = [
                request()->payment_start . " 01:00:00",
                request()->payment_date_end . " 00:00:00"
            ];
            $ids = DB::table('transaction_payments')
                ->where('business_id', session('business.id'))
                ->whereBetween('paid_on', $dates)
                ->whereNotNull('transaction_id')
                ->select('transaction_id')
                ->distinct()
                ->pluck('transaction_id')->toArray();
            $query->whereIn("id", $ids);
        }

        return DataTables::of($query)
            ->addColumn('action', function ($row) {

                $payment_methods = [
                    "transform_from_taqneen" => __('transform_from_taqneen'),
                    "for_elm" => __('for_elm'),
                    "direct_pay" => __('direct_pay')
                ];
                return view('taqneen.reports.actions', compact('row', 'payment_methods'));
            })
            ->addColumn('supplier_business_name', function ($row) {
                return optional($row->contact)->supplier_business_name;
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
}
