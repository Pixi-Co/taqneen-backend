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
            if($request->file('files')) {
                $files = $request->file('files');
                foreach ($files as $file)
                {
                    $file = $request->file('file');
                    $filename = time().'_'.$file->getClientOriginalName();
                    // File upload location
                    $location = 'tickets/files/replies';
                    // Upload file
                    $file->move($location,$filename);
                    $data['file'] = $filename;
                }
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

    public function storeGuestReply(Request $request,$id)
    {
        try {
            $data = $request->validate([
                'reply' => 'required|string',
                'file' => 'nullable|file',
                'file.*'=>'file|mimes:ppt,pptx,doc,docx,pdf,xls,xlsx,jpg,png,gif,jpeg,|max:204800',
            ]);
            if($request->file('files')) {
                $files = $request->file('files');
                foreach ($files as $file)
                {
                    $file = $request->file('file');
                    $filename = time().'_'.$file->getClientOriginalName();
                    // File upload location
                    $location = 'tickets/files/replies';
                    // Upload file
                    $file->move($location,$filename);
                    $data['file'] = $filename;
                }
            }
            $data['user_id'] = auth()->id()??null;
            $data['ticket_id'] = $id;
            if (isset($data['status_id']))
            {
                $ticket =Ticket::findOrFail($data['ticket_id']);
                $ticket->update(['status_id'=>$data['status_id']]);
            }
            TicketReply::create($data);
            $output = __('done');
        }catch (\Exception $th)
        {
            $output =  $th->getMessage();
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

    }

    public function destory($id)
    {

    }

}
