<?php

namespace App\Http\Controllers\taqneen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CustomerForm;

class CustomerFormController extends Controller
{
    public function index($form_name)
    {
        return view('taqneen.customer_forms.' . $form_name);
    } 

    public function save(Request $request)
    { 
        $key = $request->customer_type;
        $value = json_encode($request->form); 
        $resource = CustomerForm::createOrUpdate($key, $value);

        $output = [
            "success" => 1,
            "msg" => __('done')
        ];
        
        return back()->with('status', $output); 
    }

    public function viewPdf(Request $request, $file) {
        $key = $request->key; 
        $customer_id = CustomerForm::getCustomerId();
        $resource = CustomerForm::where('key', $key)->where('customer_id', $customer_id)->first();

        return view('taqneen.customer_forms.pdf.' . $file, compact('resource'));
    }
}
