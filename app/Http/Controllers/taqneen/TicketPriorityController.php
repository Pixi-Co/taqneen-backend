<?php

namespace App\Http\Controllers\taqneen;

use App\Http\Requests\taqneen\TicketPriorityRequest;
use App\TicketPriority;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class TicketPriorityController extends Controller
{
    public function index()
    {
        $priorities = TicketPriority::all();
        return view('taqneen.ticket-priority.index',compact('priorities'));
    }


    public function create()
    {
        return view('taqneen.ticket-priority.create');
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

    public function edit($id)
    {
        $priority = TicketPriority::findOrFail($id);
        return view('taqneen.ticket-priority.edit',compact('priority'));


    }

    public function update(TicketPriorityRequest $request,$id)
    {
        $updated = TicketPriority::where('id',$id)->update($request->validated());
        if ($updated)
            $output = [
                "success" => 1,
                "msg" => __('done')
            ];
        else
            $output = [
                "success" => 1,
                "msg" => __('failed')
            ];
        return redirect()->route('tickets.priorities')->with('status', $output);
    }

    public function destory($id)
    {

    }
}
