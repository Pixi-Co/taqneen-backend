<?php

namespace App\Http\Controllers\taqneen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use Carbon\Carbon;
use App\Contact;
use Illuminate\Support\Facades\DB;

class MainDashboardController extends Controller
{
    public function index()
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
        $totalSalesMonth = Transaction::where('business_id', session('business.id'))->where('created_at', '>=', $startDateOfMonth)->where('created_at', '<=', $endDateOfMonth)->sum('final_total');
        
        //sum of total sales all
        $totalSales = Transaction::where('business_id', session('business.id'))->sum('final_total');
        
        //sun of total expenses
        $totalExepnses  = Transaction::where('business_id', session('business.id'))->sum('custom_field_2');
        
        // get all opportunities
        $opportunities = Contact::where('type','opportunity')->where('business_id', session('business.id'))->latest()->get();

        
        return view("taqneen.home.index",compact('subscriptions','subscriptionsActive','subscriptionsExpire','todaySubscriptionCount','todaySubscriptionTotal','totalSalesMonth','totalSales','totalExepnses','opportunities',)); 
    } 

    public function getTotalSubscription(){
        //get total of subscription groupbry month 
        $totalSubscriptionsMonth = Transaction::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(final_total) as sum')
        )->groupBy('year','month')->get();
        
        return $totalSubscriptionsMonth;
       
    }
}
