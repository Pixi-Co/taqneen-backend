<?php

namespace App\Http\Controllers\taqneen;

use App\Http\Requests\taqneen\TicketStatusRequest;
use App\TicketStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class TicketStatusController extends Controller
{
    public function index()
    {
        $statues = TicketStatus::all();
        return view('taqneen.ticket.ticket-status.index',compact('statues'));
    }


    public function create()
    {
        return view('taqneen.ticket.ticket-status.create');
    }

    public function store(TicketStatusRequest $request)
    {

        try {
            $data = $request->validated();
            if (isset($request->is_default))
            {
                TicketStatus::query()->update(['is_default'=>0]);
                $data['is_default'] =  1;
            }
            $data['is_send_mail'] = isset($request->is_send_mail) ? 1:0;
            TicketStatus::create($data);
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
        $status = TicketStatus::findOrFail($id);
        return view('taqneen.ticket.ticket-status.edit',compact('status'));

    }

    public function update(TicketStatusRequest $request,$id)
    {
        $data =$request->validated();
        if (isset($request->is_default))
        {
            TicketStatus::query()->update(['is_default'=>0]);
            $data['is_default'] =  1;
        }
        $data['is_send_mail'] = isset($request->is_send_mail) ? 1:0;
        $updated = TicketStatus::where('id',$id)->update($data);
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
    return redirect()->route('tickets.statues')->with('status', $output);

    }

    public function destory($id)
    {
        $ticketStatus = TicketStatus::findOrFail($id);
        $ticketStatus->delete();
        return responseJson(1, __('done'));
    }

}
