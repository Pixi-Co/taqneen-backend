<?php

namespace App\Http\Controllers\taqneen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CustomerForm;
use Razorpay\Api\Customer;

class CustomerFormController extends Controller
{

    public function index($form){
        $instance = CustomerForm::class;
        $customer_id = CustomerForm::getCustomerId();
        $resource = CustomerForm::where('key', $form)->where('customer_id', $customer_id)->first();
        $item = CustomerForm::where('key', $form)->first();
        $data = json_decode($resource->value);

        if($form == 'subscribe_tamm_model')
        {
            return view('taqneen.customer_forms.tamm.index' , compact('instance','data','item'));
        }
        elseif($form == 'subscribe_masarat_model')
        {
            return view('taqneen.customer_forms.masarat.index' , compact('instance','data','item'));
        }
        elseif($form == 'subscribe_muqeem_model')
        {
            return view('taqneen.customer_forms.muqeem.index' , compact('instance','data','item'));
        }
        elseif($form == 'subscribe_naba_model')
        {
            return view('taqneen.customer_forms.naba.index' , compact('instance','data','item'));
        }
        else
        {
            return view('taqneen.customer_forms.shomoos.index' , compact('instance','data','item'));
        }
    }


    public function create($form_name)
    {
        $instance = CustomerForm::class;
        return view('taqneen.customer_forms.' . $form_name, compact('instance'));
    }

    public function save(Request $request)
    {
        try {
            $key = $request->customer_type;
            $value = json_encode($request->form);
            $resource = CustomerForm::createOrUpdate($key, $value);


            return $this->viewPdf($key);
        } catch (\Exception $th) {
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];
            return back()->with('status', $output);
        } 
    }

    public function viewPdf($key)
    {
        $file = $key;
        $customer_id = CustomerForm::getCustomerId();
        $resource = CustomerForm::where('key', $key)->where('customer_id', $customer_id)->first();
        

        if (!$resource) 
            $resource = new CustomerForm();

        $data = json_decode($resource->value);
        
        return view('taqneen.customer_forms.pdf.' . $file, compact('resource', 'data'));
    }
}
