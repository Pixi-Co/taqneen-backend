<?php

namespace App\Http\Controllers\taqneen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\System;

class CustomerFormController extends Controller
{
    public function createCustomerMasarat(){
        return view('taqneen.customer_forms.subscribe_masarat_model');
    }
    public function createCustomerMuqeem(){
        return view('taqneen.customer_forms.subscribe_muqeem_model');
    }
    public function createCustomerNaba(){
        return view('taqneen.customer_forms.subscribe_naba_model');
    }
    public function createCustomerShomoos(){
        return view('taqneen.customer_forms.subscribe_shomoos_model');
    }
    public function createCustomerTamm(){
        return view('taqneen.customer_forms.subscribe_tamm_model');
    }

    public function store(Request $request){
        // cheack type of customers forms
        if($request->customer_type == 'masarat'){
           
            $systems = System::where('key','subscribe_masarat_model')->first();
            if($systems == null){
                System::create(["key" => "subscribe_masarat_model",]);
                $systems = System::where('key','subscribe_masarat_model')->first();
                if($systems->key == 'subscribe_masarat_model'){
                    // update
                    try{
                        $data=[
                            "value" =>json_encode($request->form),
                            
                        ];
                        //dd(json_encode($request->form));
                        $systems->update($data);
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
               
            }else{
                        //update

                        try{
                            $data=[
                                "value" =>json_encode($request->form),
                                
                            ];
                            //dd(json_encode($request->form));
                            $systems->update($data);
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
        }elseif ($request->customer_type == 'muqeem') {
            $systems = System::where('key','subscribe_muqeem_model')->first();
            if($systems == null){
                System::create(["key" => "subscribe_muqeem_model",]);
                $systems = System::where('key','subscribe_muqeem_model')->first();
                if($systems->key == 'subscribe_muqeem_model'){
                    // update
                    try{
                        $data=[
                            "value" =>json_encode($request->form),
                            
                        ];
                        //dd(json_encode($request->form));
                        $systems->update($data);
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
               
            }else{
                        //update

                        try{
                            $data=[
                                "value" =>json_encode($request->form),
                                
                            ];
                            //dd(json_encode($request->form));
                            $systems->update($data);
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
        }elseif ($request->customer_type == 'naba') {
            $systems = System::where('key','subscribe_naba_model')->first();
            if($systems == null){
                System::create(["key" => "subscribe_naba_model",]);
                $systems = System::where('key','subscribe_naba_model')->first();
                if($systems->key == 'subscribe_naba_model'){
                    // update
                    try{
                        $data=[
                            "value" =>json_encode($request->form),
                            
                        ];
                        //dd(json_encode($request->form));
                        $systems->update($data);
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
               
            }else{
                        //update

                        try{
                            $data=[
                                "value" =>json_encode($request->form),
                                
                            ];
                            //dd(json_encode($request->form));
                            $systems->update($data);
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
        }elseif ($request->customer_type == 'shomoos') {
            $systems = System::where('key','subscribe_shomoos_model')->first();
            if($systems == null){
                System::create(["key" => "subscribe_shomoos_model",]);
                $systems = System::where('key','subscribe_shomoos_model')->first();
                if($systems->key == 'subscribe_shomoos_model'){
                    // update
                    try{
                        $data=[
                            "value" =>json_encode($request->form),
                            
                        ];
                        //dd(json_encode($request->form));
                        $systems->update($data);
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
               
            }else{
                        //update

                        try{
                            $data=[
                                "value" =>json_encode($request->form),
                                
                            ];
                            //dd(json_encode($request->form));
                            $systems->update($data);
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
        }
        else{
            $systems = System::where('key','subscribe_tamm_model')->first();
            if($systems == null){
                System::create(["key" => "subscribe_tamm_model",]);
                $systems = System::where('key','subscribe_tamm_model')->first();
                if($systems->key == 'subscribe_tamm_model'){
                    // update
                    try{
                        $data=[
                            "value" =>json_encode($request->form),
                            
                        ];
                        //dd(json_encode($request->form));
                        $systems->update($data);
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
               
            }else{
                        //update

                        try{
                            $data=[
                                "value" =>json_encode($request->form),
                                
                            ];
                            //dd(json_encode($request->form));
                            $systems->update($data);
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
        }
        
    }
   
}