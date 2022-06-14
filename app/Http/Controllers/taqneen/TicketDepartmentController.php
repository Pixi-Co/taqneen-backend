<?php

namespace App\Http\Controllers\taqneen;

use App\Http\Requests\taqneen\TicketDepartmentRequest;
use App\TicketDepartment;
use App\TicketPriority;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class TicketDepartmentController extends Controller
{
    public function index()
    {
        $priorities = TicketPriority::all();
        return view('taqneen.ticket-priority.index',compact('priorities'));
    }


    public function create()
    {
        $priorities = TicketPriority::all();
        return view('taqneen.ticket-departments.create',compact('priorities'));
    }

    public function store(TicketDepartmentRequest $request)
    {
        try {
            DB::beginTransaction();
            $mainDepartment = TicketDepartment::create(['name'=>$request->name]);
            foreach ($request->department_titles as $key => $departTitle){
                $insertedData =[
                  'name'=>$departTitle,
                  'priority_id'=>$request->titles_priorities[$key]
                ];
                $mainDepartment->parentDepartment()->create($insertedData);
            }


            $output = [
                "success" => 1,
                "msg" => __('done')
            ];
            DB::commit();
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

    public function edit(Request $request,$id)
    {

    }

    public function update(Request $request,$id)
    {

    }

    public function destory($id)
    {

    }
}
