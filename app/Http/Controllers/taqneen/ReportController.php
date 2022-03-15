<?php

namespace App\Http\Controllers\taqneen;

use App\Category;
use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ReportController extends Controller
{
    public function services(){
        $query = Category::join(
            'taqneen_package', 'taqneen_package.service_id', '=', 'categories.id'
        )->select(
            '*',
            'taqneen_package.name as package_name',
            'categories.name as service_name',
            'taqneen_package.type as service_type',
            DB::raw('(select sum(final_total) from transactions where transactions.id in (select transaction_id from subscription_lines where subscription_lines.package_id = taqneen_package.id)) as subscription_total'),
            DB::raw('(select sum(final_total) from transactions where is_renew != 1 and transactions.id in (select transaction_id from subscription_lines where subscription_lines.package_id = taqneen_package.id)) as subscription_new_total'),
            DB::raw('(select sum(final_total) from transactions where is_renew = 1 and  transactions.id in (select transaction_id from subscription_lines where subscription_lines.package_id = taqneen_package.id)) as subscription_renew_total'),
        )
        ->where('category_type','service')
        ->where('categories.business_id', session('business.id'))
        ->where('categories.parent_id','0')
        ->latest('categories.created_at');

        if (request()->service_id > 0) {
            $query->where('categories.id', request()->service_id);
        }

        if (request()->type) {
            $query->where('taqneen_package.type', request()->type);
        }

        $resources = $query->get();
        $services = Category::where('business_id', session('business.id'))->where('category_type','service')->get();

        return view('taqneen.reports.services_report',compact('resources', 'services'));
    }
 
    public function salesComissions(){ 
        $opportunities = Contact::where('type','opportunity')->where('business_id', session('business.id'))->latest()->get();
        return view('taqneen.reports.sales_commision_reportes',compact('opportunities'));
    }
}
