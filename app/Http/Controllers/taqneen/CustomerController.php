<?php

namespace App\Http\Controllers\taqneen;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index(){
        $customers = Contact::where('type','customer')->where('business_id', session('business.id'))->latest()->get();
        return view('taqneen.customers.index',compact('customers'));
    }


    public function create(){
        $customer = new Contact();
        return view('taqneen.customers.form',compact('customer'));
    }

    
    public function show($id){
        $customer = Contact::find($id);
        //dd($customer);
        return view('taqneen.customers.profile',compact('customer'));
    }

    
    public function edit($id){
        $customer = Contact::find($id);
        return view('taqneen.customers.form',compact('customer'));

    }

    public function store(Request $request){
       // dd($request->all());

        try{
            $data=[
                "supplier_business_name" => $request->supplier_business_name,
                "custom_field1" => $request->custom_field1,
                "mobile" => $request->mobile,
                "email" => $request->email,
                "state" => $request->state,
                "address_line_1" => $request->address_line_1,
                "address_line_2" => $request->address_line_2,
                "zip_code" => $request->zip_code,
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "name" => $request->first_name .' '. $request->last_name,
                "business_id" =>session('business.id'),
                "created_by" => session('user.id'),
                "type" => 'customer',
            ];
            
            Contact::create($data);

            $output = [
                "success" => 1,
                "msg" => __('done')
            ];

        } catch (\Exception $th) {
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];
        }
       
        return back()->with('status', $output); 
    }


    public function update(Request $request,$id){
        if($request->profile == 'profile'){

            try{
                $data=[
                    "first_name" => $request->first_name,
                    "last_name" => $request->last_name,
                    "name" => $request->first_name .' '. $request->last_name,
                    "mobile" => $request->mobile,
                    "email" => $request->email,
                    "country" => $request->country,
                    "address_line_1" => $request->address_line_1,
                    "address_line_2" => $request->address_line_2,
                    "zip_code" => $request->zip_code,
                    "city" =>$request->city,
                    "type" => 'customer',
                ];
                //dd($data);
                $contact = Contact::find($id);
                $contact->update($data);
                $output = [
                    "success" => 1,
                    "msg" => __('done')
                ];
    
            } catch (\Exception $th) {
                $output = [
                    "success" => 0,
                    "msg" => $th->getMessage()
                ];
            }
            return back()->with('status', $output); 
            
        }else{
            try{
                $data=[
                    "supplier_business_name" => $request->supplier_business_name,
                    "custom_field1" => $request->custom_field1,
                    "mobile" => $request->mobile,
                    "email" => $request->email,
                    "state" => $request->state,
                    "address_line_1" => $request->address_line_1,
                    "address_line_2" => $request->address_line_2,
                    "zip_code" => $request->zip_code,
                    "first_name" => $request->first_name,
                    "last_name" => $request->last_name,
                    "name" => $request->first_name .' '. $request->last_name,
                    "business_id" =>session('business.id'),
                    "created_by" => session('user.id'),
                    "type" => 'customer',
                ];
                //dd($data);
                $contact = Contact::find($id);
                $contact->update($data);
                $output = [
                    "success" => 1,
                    "msg" => __('done')
                ];
    
            } catch (\Exception $th) {
                $output = [
                    "success" => 0,
                    "msg" => $th->getMessage()
                ];
            }
            return redirect('/customers')->with('status', $output);     
        }
            
    }


    public function destroy($id) {
        try { 
            $contact = Contact::find($id);
            $contact->delete();
            $output = [
                "success" => 1,
                "msg" => __('delete successfull')
            ];
        } catch (\Exception $th) {
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];
        }

        return $output; 
    }// end destroy



}
