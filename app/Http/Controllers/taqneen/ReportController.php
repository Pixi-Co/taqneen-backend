<?php

namespace App\Http\Controllers\taqneen;

use App\Category;
use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function services(){
        $services = Category::where('category_type','service')->where('business_id', session('business.id'))->where('parent_id','0')->latest()->get();
        return view('taqneen.reports.services_report',compact('services'));
    }
 
    public function salesComissions(){ 
        $opportunities = Contact::where('type','opportunity')->where('business_id', session('business.id'))->latest()->get();
        return view('taqneen.reports.sales_commision_reportes',compact('opportunities'));
    }
}
