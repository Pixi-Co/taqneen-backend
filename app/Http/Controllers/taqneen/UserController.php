<?php

namespace App\Http\Controllers\taqneen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use FontLib\Table\Type\name;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function index(){
        $users = User::where('user_type','user')->where('business_id', session('business.id'))->latest()->get();
        return view('taqneen.users.index',compact('users'));
    }

    public function create(){
        
        $user = new User();
        $roles = Role::where('business_id', session('business.id'))->pluck('name','name')->all();
        //dd($roles);
        return view('taqneen.users.form',compact('user','roles'));
    }

    public function edit($id){
        $user = User::find($id);
        $roles = Role::where('business_id', session('business.id'))->pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->first();
        
        return view('taqneen.users.form',compact('user','roles','userRole'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'password' => 'required|same:confirm_password',
            'roles' => 'required',
            //'image' =>'image'
        ]);
    //  dd($request->input('roles'));
       // $image =  bcrypt($request->image);
        try{
            $image = $request->custom_field_1->hashName();
            //dd($image);
            $data=[
                "first_name" => $request->first_name,
                "email" => $request->email,
                "contact_number" => $request->contact_number,
                "address" => $request->address,
                "custom_field_1" => $request->custom_field_1->hashName(),
                "password" => bcrypt($request->password),
                "business_id" =>session('business.id'),
                "user_type" => 'user',
            ];
            
            //dd($request->custom_field_1->hashName());
            //Storage::save('/users_images/'.bcrypt($request->image),$request->image);
            if($request->custom_field_1){
                Storage::put('/users_images/',$request->custom_field_1);
            }
            
            $user= User::create($data);     
            $user->assignRole($request->input('roles'));


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

    public function update(Request $request, $id)
    {  //dd($request->all());
        // $this->validate($request, [
        //     'password' => 'required|same:confirm_password',
        // ]);
        //$image =  bcrypt($request->image);
        $user = User::find($id);
        try{
            $data=[
                "first_name" => $request->first_name,
                "email" => $request->email,
                "contact_number" => $request->contact_number,
                "address" => $request->address,
                "custom_field_1" => $request->custom_field_1->hashName(),
                "password" => $request->password,
            ];
            if(!empty($data["password"])){
                $data["password"] = bcrypt($request->password);
            }else{
                $data = Arr::except($data,array('password'));
            }
            if($request->custom_field_1){
                if($request->custom_field_1->hashName() != $user->custom_field_1){
                    Storage::delete('/users_images/'.$user->custom_field_1);
                }
                Storage::put('/users_images/',$request->custom_field_1);
            }

           
            $user->update($data);
            DB::table('model_has_roles')->where('model_id',$id)->delete();
    
            $user->assignRole($request->input('roles'));
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


    public function destroy($id) {
        try { 
            $user = User::find($id);
            Storage::delete('/users_images/'.$user->custom_field_1);
            $user->delete();
           
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
