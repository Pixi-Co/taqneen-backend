<?php

namespace App\Http\Controllers\taqneen;

use App\Http\Requests\taqneen\TicketReplyRequest;
use App\Ticket;
use App\TicketReply;
use App\TicketStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class TicketReplyController extends Controller
{

    public function store(TicketReplyRequest $request)
    {

        try {
            $data = $request->validated();
            if($request->file('file')) {
                $file = $request->file('file');
                $filename = time().'_'.$file->getClientOriginalName();
                // File upload location
                $location = 'tickets/files/replies';
                // Upload file
                $file->move($location,$filename);
                $data['file'] = $filename;
            }
            $data['user_id'] = auth()->id();
            if (isset($data['status_id']))
            {
                $ticket =Ticket::findOrFail($data['ticket_id']);
                $ticket->update(['status_id'=>$data['status_id']]);
            }
            TicketReply::create($data);
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
