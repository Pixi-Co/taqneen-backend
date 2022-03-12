<?php

namespace App\Http\Controllers\taqneen;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class serviceReportController extends Controller
{
    public function index(){
        $services = Category::where('category_type','service')->where('business_id', session('business.id'))->where('parent_id','0')->latest()->get();
        return view('taqneen.reports.services_report',compact('services'));
    }
} 
