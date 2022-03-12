<?php

namespace App\Http\Controllers\taqneen;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subscription;
use App\Transaction;

class SaleCommisionController extends Controller
{
    public function index(){
       
        $opportunities = Contact::where('type','opportunity')->where('business_id', session('business.id'))->latest()->get();
       
        return view('taqneen.reports.sales_commision_reportes',compact('opportunities'));
    }
}
