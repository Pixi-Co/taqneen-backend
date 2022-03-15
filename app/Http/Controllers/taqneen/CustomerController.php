<?php

namespace App\Http\Controllers\taqneen;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Role;

class CustomerController extends Controller
{
    public function index(){
        $customers = Contact::where('type','customer')->where('business_id', session('business.id'))->latest()->get();
        return view('taqneen.customers.index',compact('customers'));
    }


    public function create(){
        $customer = new Contact();
        $roles = Role::where('business_id', session('business.id'))->pluck('name','name')->all();


        return view('taqneen.customers.form',compact('customer','roles'));
    }

    
    public function show($id){
        $customer = Contact::find($id);
        //dd($customer);
        return view('taqneen.customers.profile',compact('customer'));
    }

    
    public function edit($id){
       
        $customer = Contact::find($id);
        $user = $customer->loginUser;
        $roles = Role::where('business_id', session('business.id'))->pluck('name','name')->all();
        $userRole = $user->roles()->first();
        $customer->role = $userRole->name;

        //dd($customer->toArray());
        return view('taqneen.customers.form',compact('customer','userRole','roles'));

    }

    public function store(Request $request){
       // dd($request->all());
       $this->validate($request, [
        'password' => 'required|same:confirm_password',
        'roles' => 'required',
    ]);
 
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
            
            $contact = Contact::create($data);
            $this->createOrUpdateUser($contact, $request);

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
       //dd($output);
        return back()->with('status', $output); 
    }


    public function update(Request $request,$id){
        // $this->validate($request, [
        //     'password' => 'required|same:confirm_password',
        //     'roles' => 'required',
        // ]);

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
                $this->createOrUpdateUser($contact, $request);
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


    public function createOrUpdateUser(Contact $customer, Request $request) { 
        $user = $customer->loginUser;

        if ($user) {
            // update 
           
            $data=[
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "email" => $request->email,
                "contact_number" => $request->contact_number,
                "address" => $request->address_line_1,
                "password" => bcrypt($request->password),
            ];

            if(!empty($data["password"])){
                $data["password"] = bcrypt($request->password);
            }else{
                $data = Arr::except($data,array('password'));
            } 
            $user->update($data);   
 
            $role = $user->roles()->first();  
            $newRole = Role::find($request->input('roles'));
            //
            $user->removeRole($user->roles()->pluck('name')->toArray()); 
            $user->roles()->detach();
            $user->forgetCachedPermissions();
            $user->assignRole($newRole->name); 
        } else {
            // create
           
           
            $user= User::create([
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "email" => $request->email,
                "contact_number" => $request->contact_number,
                "address" => $request->address_line_1,
                "password" => bcrypt($request->password),
                "business_id" =>session('business.id'),
                "user_type" => 'user_customer',
            ]);     
            $user->assignRole($request->input('roles'));

            $customer->converted_by = $user->id;
            $customer->update();
        }

        return $user;
    }


}
