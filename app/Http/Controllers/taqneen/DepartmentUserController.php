<?php

namespace App\Http\Controllers\taqneen;

use App\DepartmentUser;
use App\Http\Requests\taqneen\DepartmentUserRequest;
use App\TicketDepartment;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class DepartmentUserController extends Controller
{
    public function index()
    {
        $departmentUsers = DepartmentUser::with(['user','ticket'])->get();
        $departmentUsers = $departmentUsers->groupBy('ticket.name');
        return view('taqneen.department-users.index',compact('departmentUsers'));
    }


    public function create()
    {
        $users = User::where('user_type','user_customer')->get();
        $departments = TicketDepartment::all();
        $mainDepartments = $departments->where('parent_id',null);
        $subDepartments =$departments->where('parent_id','!==',null);
        return view('taqneen.department-users.create',compact('mainDepartments','subDepartments','users'));
    }

    public function store(DepartmentUserRequest $request)
    {
        try {

            foreach ($request->users as $user){
                $insertedData=[
                  'ticket_id'=>$request->sub_department,
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

    }

    public function update(Request $request,$id)
    {

    }

    public function destory($id)
    {

    }
}
