<?php

namespace App\Http\Controllers\taqneen;

use App\Http\Requests\taqneen\TicketDepartmentRequest;
use App\Http\Requests\taqneen\TicketDepartmentUpdateRequest;
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
        $departments = TicketDepartment::whereNull('parent_id')->with('subDepartments')->get();
        return view('taqneen.ticket.ticket-departments.index',compact('departments'));
    }


    public function create()
    {
        $priorities = TicketPriority::all();
        return view('taqneen.ticket.ticket-departments.create',compact('priorities'));
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
                $mainDepartment->subDepartments()->create($insertedData);
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

    public function edit($id)
    {
        $ticketDepartment = TicketDepartment::with('subDepartmentsWithPriorty')->findOrFail($id);
        $periorites = TicketPriority::all();
        return view('taqneen.ticket.ticket-departments.edit',compact('ticketDepartment','periorites'));


    }

    public function update(TicketDepartmentUpdateRequest $request,$id)
    {

        try {
            DB::beginTransaction();
            $mainDepartment = TicketDepartment::findOrFail($id);
            $mainDepartment->subDepartments()->delete();
            $mainDepartment->update(['name'=>$request->name]);
            if (isset($request->department_titles))
            foreach ($request->department_titles as $key => $departTitle){
                $insertedData =[
                    'name'=>$departTitle,
                    'priority_id'=>$request->titles_priorities[$key],
                    'parent_id'=>$id
                ];
                $mainDepartment->subDepartments()->updateOrCreate($insertedData);
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
                "msg" => trans('canot_remove_some_departments_as_it_linked_to_other_rows')
            ];
        }
        return redirect()->route('tickets.departments')->with('status', $output);
    }

    public function delete($id)
    {

        $ticketDepartment =TicketDepartment::where('id',$id)->with('subDepartments')->delete();
        if ($ticketDepartment)
            return response()->json(['success' => true,
                'msg' => trans("deleted_success")
            ]);
    }
}
