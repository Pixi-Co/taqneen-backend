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
        $business_id = request()->session()->get('user.business_id');

        $query = Subscription::query()
        ->where('transactions.business_id', $business_id)
        ->where('is_renew', '0');
 

        if (find_or_create_p('subscriptions.own_data', 'subscriptions')) {
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

        if (request()->ajax()) {
            return responseJson(1, count($resources) . " " . __('data_found'), view('taqneen.reports.services_report', compact('resources'))->render());
        }
 
        return view('taqneen.reports.services_report', compact('resources'));
    }

    public function salesComissions()
    {
        
        $business_id = request()->session()->get('user.business_id');

        $query = Subscription::query()
        ->where('transactions.business_id', $business_id)
        ->where('is_renew', '0');
 

        if (find_or_create_p('subscriptions.own_data', 'subscriptions')) {
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

        $resources = User::couriers()->where('user_type','user')->where('business_id', session('business.id'))->latest()->get();
 
        foreach($resources as $resource) {
            $queryClone = clone $query;  
            $resource->number = $queryClone->where("created_by", $resource->id)->count();
            $resource->sum = $queryClone->where("created_by", $resource->id)->sum('final_total');
        }

        if (request()->ajax()) {
            return responseJson(1, count($resources) . " " . __('data_found'), view('taqneen.reports.sales_commision_reportes', compact('resources'))->render());
        }
 
        return view('taqneen.reports.sales_commision_reportes', compact('resources'));
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
