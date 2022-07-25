<?php

namespace App\Http\Controllers\taqneen;

use App\Category;
use Carbon\Carbon;
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
        $defaultTaqneenSessionId = 19;
        $business_id = request()->session()->get('user.business_id') ?? $defaultTaqneenSessionId;

        $query = Subscription::query()
            ->where('transactions.business_id', $business_id);


        if (auth()->user()->can(find_or_create_p('subscriptions.own_data', 'subscriptions')) && !auth()->user()->isAdmin()) {
            $query->where('transactions.created_by', auth()->user()->id);
        }

        if (request()->payment_status) {
            $query->where('transactions.shipping_custom_field_2', request()->payment_status);
        }

        if (request()->register_date_start && request()->register_date_end) {
            $dates = [
                request()->register_date_start,
                request()->register_date_end
            ];
            $query->whereBetween(DB::raw('date(transactions.shipping_custom_field_1)'), $dates);
        }

        if (request()->transaction_date_start && request()->transaction_date_end) {
            $dates = [
                request()->transaction_date_start ,
                request()->transaction_date_end
            ];
            $query->whereBetween(DB::raw('date(transactions.transaction_date)'), $dates);

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
                request()->payment_date_start,
                request()->payment_date_end
            ];
            $ids = DB::table('transaction_payments')
                ->where('business_id', session('business.id'))
                ->whereBetween(DB::raw('date(paid_on)'), $dates)
                ->whereNotNull('transaction_id')
                ->select('transaction_id')
                ->distinct()
                ->pluck('transaction_id')->toArray();
            $query->whereIn("transactions.id", $ids);
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

        $resources = Category::where('business_id', session('user.business_id'))->where('category_type', 'service')->get();

        foreach($resources as $resource) {
            $queryClone = clone $query;
            $ids = DB::table('subscription_lines')
                ->where('service_id', $resource->id)
                ->select('transaction_id')
                ->distinct()
                ->pluck('transaction_id')->toArray();

            $resource->number = $queryClone->whereIn("transactions.id", $ids)->count();
            $resource->sum = $queryClone->whereIn("transactions.id", $ids)->sum('final_total');
        }
        $users = User::couriers()->where('user_type','user')->where('business_id', session('business.id'))->latest()->get();

        if (request()->ajax()) {
            return responseJson(1, count($resources) . " " . __('data_found'), view('taqneen.reports.services_report', compact('resources', 'users'))->render());
        }

        return view('taqneen.reports.services_report', compact('resources', 'users'));
    }

    public function salesComissions()
    {

        $business_id = request()->session()->get('user.business_id');

        $query = Subscription::query()
            ->where('transactions.business_id', $business_id);


        if (auth()->user()->can(find_or_create_p('subscriptions.own_data', 'subscriptions')) && !auth()->user()->isAdmin()) {
            $query->where('transactions.created_by', auth()->user()->id);
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
                $query->where('is_renew', '0');
            else
                $query->where('is_renew', '1');
        }

        $resources = User::couriers()->where('user_type','user')->where('business_id', session('business.id'))->latest()->get();

        foreach($resources as $resource) {
            $queryClone = clone $query;
            $resource->number = $queryClone->where("created_by", $resource->id)->count();
            $resource->sum = $queryClone->where("created_by", $resource->id)->sum('final_total');
            $resource->total = $queryClone->where("created_by", $resource->id)->sum('final_total') - $queryClone->where("created_by", $resource->id)->sum('tax_amount');
        }
        $services = Category::where('business_id', session('user.business_id'))->where('category_type', 'service')->get();

        if (request()->ajax()) {
            return responseJson(1, count($resources) . " " . __('data_found'), view('taqneen.reports.sales_commision_reportes', compact('resources', 'services'))->render());
        }

        return view('taqneen.reports.sales_commision_reportes', compact('resources', 'services'));
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
            'subscription_expire_total' => DB::table('transactions')->where("business_id", $business_id)->where('expire_date', "<=", date('Y-m-d'))->sum('final_total'),
            'subscription_active_total' => Transaction::where('business_id', session('business.id'))->where('is_expire', '0')->sum('final_total'),
            'subscription_will_expire_total' => Subscription::getExpireSubscriptionForThisMonth()->sum('final_total'),
            'chart' => Transaction::where('business_id', session('business.id'))->pluck('transaction_date', 'final_total')->toArray(),
        ];

        $users = User::couriers()->get()->pluck('user_full_name', 'id')->toArray();
        return view('taqneen.reports.subscription', compact("services", "data", "users"));
    }

    public function dataOfSubscription()
    {
        $defaultBusinessId = 19 ;
        $business_id = request()->session()->get('user.business_id')??$defaultBusinessId;

        $query = Subscription::join(
            "contacts", "contacts.id", "=", "transactions.contact_id"
        )->where('transactions.business_id', $business_id);;

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
                $query->where('transactions.is_renew', '0');
            else
                $query->where('transactions.is_renew', '1');
        }

        if (request()->transaction_date!==null) {
            $dates = explode(' - ',request()->transaction_date);
            $query->whereBetween(DB::raw('DATE(transactions.transaction_date)'), [$dates[0],$dates[1]]);
        }

        if (request()->expire_date!==null) {
            $dates =explode(' - ',request()->expire_date);
            $query->where(function($q) use ($dates){
                $q
                    ->whereBetween(DB::raw('DATE(transactions.expire_date)'),[ $dates[0],$dates[1]])
                    ->orWhereBetween(DB::raw('(select expire_date from transactions tr where tr.id = transactions.transfer_parent_id)'),[ $dates[0],$dates[1]])
                    ->orWhereBetween(DB::raw("(select expire_date from transactions t where t.contact_id = transactions.contact_id and t.id < transactions.id  limit 1)"), [$dates[0],$dates[1]]);
            });
        }

        if (request()->payment_date!==null) {
            $dates = explode(' - ',request()->payment_date);
            $ids = DB::table('transaction_payments')
                ->latest()
                ->where('business_id', session('business.id'))
                ->whereBetween('paid_on', [$dates[0],$dates[1]])
                ->whereNotNull('transaction_id')
                ->select('transaction_id')
                ->distinct()
                ->pluck('transaction_id')->toArray();
            $query->whereIn("transactions.id", $ids);
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
                return optional($row)->supplier_business_name;
            })
            ->addColumn('first_name', function ($row) {
                return optional($row)->first_name;
            })
            ->addColumn('mobile', function ($row) {
                return optional($row)->mobile;
            })
            ->addColumn('mobile', function ($row) {
                return optional($row)->mobile;
            })
            ->editColumn('created_by', function ($row) {
                return optional($row)->first_name;
            })
            ->editColumn('final_total', function ($row) {
                return number_format($row->final_total, 2);
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
