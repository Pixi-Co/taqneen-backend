<?php

namespace App\Http\Controllers\taqneen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        /*$now = Carbon::now();
        $startDateOfMonth = $now->startOfMonth()->format('Y-m-d H:i:s');
        $startDateOfMonth = $now->endOfMonth()->format('Y-m-d H:i:s');*/

        $roles = Role::where('business_id', session('business.id'))->get();
        return view('taqneen.roles.index',compact('roles'));
    }

    public function create() {
        $role = new Role();
        $groups = Permission::select('group')->distinct('group')->pluck('group')->toArray();
        $permission = Permission::class;
        
        return view('taqneen.roles.form',compact('role','permission', 'groups'));
    }


    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
        ]);  

        try{
            $role = Role::create([
                "name" => $request->input('name'),
                "business_id" =>session('business.id'),
            ]);
            $role->syncPermissions($request->input('permission'));
            
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

    public function edit($id){ 
        $role = Role::find($id); 
        $rolePermissions  = $role->permissions->pluck('name');
        $groups = Permission::select('group')->distinct('group')->pluck('group')->toArray();
        $permission = Permission::class;
       // dd($rolePermissions,$role);
        return view('taqneen.roles.form',compact('role','permission','rolePermissions', 'groups'));
    }

    public function update(Request $request, $id){
        $role = Role::find($id);
        try{
            $role->update([
                "name" => $request->input('name'),
            ]);
            $role->syncPermissions($request->input('permission'));
            
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


    public function destroy($id){
        try { 
            Role::find($id)->delete();
           
           
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
    }
}

