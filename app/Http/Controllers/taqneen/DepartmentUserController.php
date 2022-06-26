<?php

namespace App\Http\Controllers\taqneen;

use App\DepartmentUser;
use App\Http\Requests\taqneen\DepartmentUserRequest;
use App\Http\Requests\taqneen\DepartmentUserUpdateRequest;
use App\TicketDepartment;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class DepartmentUserController extends Controller
{
    public function index()
    {
        $departmentUsers = DepartmentUser::with(['user','department'])->get();
        return view('taqneen.ticket.department-users.index',compact('departmentUsers'));
    }


    public function create()
    {
        $users = User::where('user_type','user_customer')->get();
        $departments = TicketDepartment::all();
        $mainDepartments = $departments->where('parent_id',null);
        $subDepartments =$departments->where('parent_id','!==',null);
        return view('taqneen.ticket.department-users.create',compact('mainDepartments','subDepartments','users'));
    }

    public function store(DepartmentUserRequest $request)
    {
        try {

            foreach ($request->users as $user){
                $insertedData=[
                  'department_id'=>$request->sub_department,
                  'user_id'=>$user,
                ];
                DepartmentUser::updateOrCreate($insertedData);
            }

            $output = [
                "success" => 1,
                "msg" => __('done')
            ];

        }catch (\Exception $th)
        {
            DB::rollBack();
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];
        }
        return back()->with('status', $output);
    }

    public function edit($id)
    {
        $users = User::where('user_type','user_customer')->get();
        $targetDepartment = DepartmentUser::with('department')->findOrFail($id);
        $departments = TicketDepartment::all();
        $mainDepartments = $departments->where('parent_id',null);
        $subDepartments =$departments->where('parent_id','!==',null);
        return view('taqneen.ticket.department-users.edit',compact('mainDepartments','subDepartments','users','targetDepartment'));

    }

    public function update(DepartmentUserUpdateRequest $request,$id)
    {
        $data['department_id'] = $request->sub_department;
        $data['user'] = $request->user;
        $data['is_active'] = isset($request->is_Active)?1:0;
        $departmentUser =DepartmentUser::findOrFail($id);
        $departmentUser->update($data);
        $output = [
            "success" => 1,
            "msg" => __('done')
        ];
        return redirect(route('department.users'))->with('status',$output);

    }

    public function activateAll($id)
    {
        DepartmentUser::where('ticket_id',$id)->update(['is_active'=>1]);
        $output = [
            "success" => 1,
            "msg" => __('done')
        ];
        return back()->with('status', $output);
    }

    public function deactivateAll($id)
    {
        DepartmentUser::where('ticket_id',$id)->update(['is_active'=>0]);
        $output = [
            "success" => 1,
            "msg" => __('done')
        ];
        return back()->with('status', $output);
    }

    public function status($id)
    {
        $departmentUser = DepartmentUser::findOrFail($id);
        $is_active = $departmentUser->is_active==1? 0 : 1;
        $departmentUser->update(['is_active'=>$is_active]);
        $output = [
            "success" => 1,
            "msg" => __('done')
        ];
        return back()->with('status', $output);
    }

    public function delateAllForDepartment($id)
    {
        DepartmentUser::where('ticket_id',$id)->delete();
        return responseJson(1, __('done'));

    }

    public function destory($id)
    {
        try {
            $departmentUser = DepartmentUser::findOrFail($id);
            $departmentUser->delete();
            return responseJson(1, __('done'));
        }catch (\Exception $exception)
        {
            return responseJson(1, __('support.fail'));
        }
    }
}
