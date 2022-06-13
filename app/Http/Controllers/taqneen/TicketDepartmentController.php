<?php

namespace App\Http\Controllers\taqneen;

use App\Http\Requests\taqneen\TicketPriorityRequest;
use App\TicketPriority;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class TicketDepartmentController extends Controller
{
    public function index()
    {
        $priorities = TicketPriority::all();
        return view('taqneen.ticket-priority.index',compact('priorities'));
    }


    public function create()
    {
        return view('taqneen.ticket-departments.create');
    }

    public function store(TicketPriorityRequest $request)
    {

        try {
            TicketPriority::create($request->validated());
            $output = [
                "success" => 1,
                "msg" => __('done')
            ];
        }catch (\Exception $th)
        {
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

    public function destory($id)
    {

    }
}
