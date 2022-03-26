<?php

namespace App\Http\Controllers\taqneen;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use Carbon\Carbon;
use App\Contact;
use Illuminate\Support\Facades\DB;

class MainDashboardController extends Controller
{

    public function index() {
        if (auth()->user()->can('dashboard.admin')) {
            return $this->admin();
        } 
        
        if (auth()->user()->can('dashboard.courier') && !auth()->user()->can('dashboard.courier')) {
            return $this->courier();
        } 

        return view('taqneen.home.index');
    }

    public function admin()
    {
        //$now = Carbon::now()->subDays()->toDayDateTimeString()->date_format();
         
        $todaySubscriptionTotal = Transaction::where('business_id', session('business.id'))->where('transaction_date', 'like', '%'.date('Y-m-d').'%')->sum('final_total');
        $todaySubscriptionCount = Transaction::where('business_id', session('business.id'))->where('transaction_date', 'like', '%'.date('Y-m-d').'%')->count();
 
        
        // total of subscriptions
        $subscriptions = Transaction::where('business_id', session('business.id'))->count();
        $subscriptionsActive = Transaction::where('business_id', session('business.id'))->where('is_expire','0')->count();
        $subscriptionsExpire = Transaction::where('business_id', session('business.id'))->where('is_expire','1')->count();
        // sum of totalsales in this month
        $now = Carbon::now();
        $startDateOfMonth = $now->startOfMonth()->format('Y-m-d H:i:s');
        $endDateOfMonth = $now->endOfMonth()->format('Y-m-d H:i:s');
        $totalSalesMonth = Transaction::where('business_id', session('business.id'))->where('transaction_date', '>=', $startDateOfMonth)->where('transaction_date', '<=', $endDateOfMonth)->sum('final_total');
        
        $now = Carbon::now();
        $startDateOfLastMonth = $now->subDays(30)->startOfMonth()->format('Y-m-d H:i:s');
        $endDateOffLastMonth = $now->subDays(30)->endOfMonth()->format('Y-m-d H:i:s');
        $totalSaleslastMonth = Transaction::where('business_id', session('business.id'))->where('transaction_date', '>=', $startDateOfLastMonth)->where('transaction_date', '<=', $endDateOffLastMonth)->sum('final_total');
         
        $now = Carbon::now();
        $startDateOfYear = $now->startOfYear()->format('Y-m-d H:i:s');
        $endDateOffYear = $now->endOfYear()->format('Y-m-d H:i:s');
        $totalSalesYear = Transaction::where('business_id', session('business.id'))->where('transaction_date', '>=', $startDateOfYear)->where('transaction_date', '<=', $endDateOffYear)->sum('final_total');
        
        //sum of total sales all
        $totalSales = Transaction::where('business_id', session('business.id'))->sum('final_total');
        
        //sun of total expenses
        $totalExepnses  = Transaction::where('business_id', session('business.id'))->sum('custom_field_2');
        
        // get all opportunities
        $opportunities = Contact::where('type','opportunity')->where('business_id', session('business.id'))->where('converted_by',null)->latest()->get();
        
        $data = [
            'chart' => Transaction::where('business_id', session('business.id'))->pluck('transaction_date', 'final_total')->toArray(),
        ];

        $customerTotal = Contact::where('type', 'customer')->where('business_id', session('business.id'))->count();
        $serviceCount = Category::where('category_type', 'service')->where('business_id', session('business.id'))->count(); 

        return view("taqneen.home.index",compact(
            'subscriptions','subscriptionsActive',
            'subscriptionsExpire','todaySubscriptionCount',
            'todaySubscriptionTotal','totalSalesMonth',
            'totalSales','totalExepnses',
            'opportunities', 'data', 'totalSaleslastMonth', 
            'totalSalesYear', 'customerTotal', 'serviceCount')); 
    } 
    
    public function courier()
    {
        //$now = Carbon::now()->subDays()->toDayDateTimeString()->date_format();
         
        $todaySubscriptionTotal = Transaction::where('business_id', session('business.id'))->where('transaction_date', 'like', '%'.date('Y-m-d').'%')->where('created_by',session('user.id'))->sum('final_total');
        $todaySubscriptionCount = Transaction::where('business_id', session('business.id'))->where('transaction_date', 'like', '%'.date('Y-m-d').'%')->where('created_by',session('user.id'))->count();
 
        
        // total of subscriptions
        $subscriptions = Transaction::where('business_id', session('business.id'))->where('created_by',session('user.id'))->count();
        $subscriptionsActive = Transaction::where('business_id', session('business.id'))->where('is_expire','0')->where('created_by',session('user.id'))->where('created_by',session('user.id'))->count();
        $subscriptionsExpire = Transaction::where('business_id', session('business.id'))->where('is_expire','1')->where('created_by',session('user.id'))->where('created_by',session('user.id'))->count();
        // sum of totalsales in this month
        $now = Carbon::now();
        $startDateOfMonth = $now->startOfMonth()->format('Y-m-d H:i:s');
        $endDateOfMonth = $now->endOfMonth()->format('Y-m-d H:i:s');
        $totalSalesMonth = Transaction::where('business_id', session('business.id'))->where('transaction_date', '>=', $startDateOfMonth)->where('transaction_date', '<=', $endDateOfMonth)->where('created_by',session('user.id'))->sum('final_total');
        
        $now = Carbon::now();
        $startDateOfLastMonth = $now->subDays(30)->startOfMonth()->format('Y-m-d H:i:s');
        $endDateOffLastMonth = $now->subDays(30)->endOfMonth()->format('Y-m-d H:i:s');
        $totalSaleslastMonth = Transaction::where('business_id', session('business.id'))->where('transaction_date', '>=', $startDateOfLastMonth)->where('transaction_date', '<=', $endDateOffLastMonth)->where('created_by',session('user.id'))->sum('final_total');
         
        $now = Carbon::now();
        $startDateOfYear = $now->startOfYear()->format('Y-m-d H:i:s');
        $endDateOffYear = $now->endOfYear()->format('Y-m-d H:i:s');
        $totalSalesYear = Transaction::where('business_id', session('business.id'))->where('transaction_date', '>=', $startDateOfYear)->where('transaction_date', '<=', $endDateOffYear)->where('created_by',session('user.id'))->sum('final_total');
        
        //sum of total sales all
        $totalSales = Transaction::where('business_id', session('business.id'))->where('created_by',session('user.id'))->sum('final_total');
        
        //sun of total expenses
        $totalExepnses  = Transaction::where('business_id', session('business.id'))->where('created_by',session('user.id'))->sum('custom_field_2');
        
        // get all opportunities
        $opportunities = Contact::where('type','opportunity')
            ->where('business_id', session('business.id'))
            ->whereNull('converted_by')
            ->orWhere('created_by',session('user.id'))
            ->latest()
            ->get();
        
        $opportunitiesTotal = Contact::where('type', 'opportunity')->where('business_id', session('business.id'))->where('converted_by',session('user.id'))->count();

        $data = [
            'chart' => Transaction::where('business_id', session('business.id'))->where('created_by',session('user.id'))->pluck('transaction_date', 'final_total')->toArray(),
        ];

        $serviceCount = Category::where('category_type', 'service')->where('business_id', session('business.id'))->where('created_by',session('user.id'))->count(); 

        return view("taqneen.home.courier",compact(
            'subscriptions','subscriptionsActive',
            'subscriptionsExpire','todaySubscriptionCount',
            'todaySubscriptionTotal','totalSalesMonth',
            'totalSales','totalExepnses',
            'opportunities', 'data', 'totalSaleslastMonth', 
            'totalSalesYear', 'opportunitiesTotal', 'serviceCount')); 
    } 

    public function getTotalSubscription(){
        //get total of subscription groupbry month 
        $totalSubscriptionsMonth = Transaction::pluck('final_total')->toArray();
        
        return $totalSubscriptionsMonth;
       
    }


    public function ticket() {
        return view('taqneen.support.ticket');
    }
}
