<?php

namespace App\Http\Controllers\taqneen;

use App\EmailTemplate;
use App\Http\Requests\taqneen\TicketReplyRequest;
use App\Ticket;
use App\TicketReply;
use App\TicketStatus;
use App\Triger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ZipArchive;



class TicketReplyController extends Controller
{

    public function store(TicketReplyRequest $request)
    {
        try {
            $data = $request->validated();
            if ($request->hasFile('files'))
            {
                $files = $request->file('files');
                foreach ($files as $file)
                {
                    $filename = time().'_'.$file->getClientOriginalName();
                    // File upload location
                    $location = 'tickets/files/replies';
                    // Upload file
                    $file->move($location,$filename);
                    $data['file'][] = $filename;
                }
            }
            $data['user_id'] = auth()->id();
            if (isset($data['status_id']))
            {
                $ticket =Ticket::findOrFail($data['ticket_id']);
                $ticket->update(['status_id'=>$data['status_id']]);
            }

            $ticketReply = TicketReply::create($data);

            if ($ticketReply && isset($data['status_id']))
            {
                $status = TicketStatus::find($data['status_id']);
                $checkTrigger = $this->checkStatusTrigger(strtoupper($status->name));
                if ($checkTrigger)
                    Triger::fire2(strtoupper($status->name), $ticket);
            }
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
            $data['ticket_id'] = $id;
            $data['status_id'] = TicketStatus::where('is_default',1)->first()->id;
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

    public function checkStatusTrigger($status)
    {
        return (boolean) (EmailTemplate::where('template_for',$status)->first());
    }

    public function downloadTicketReplyFiles($id)
    {
        $ticket = TicketReply::findOrFail($id);
        if ($ticket && !is_null($ticket->file))
        {
            $archiveName = 'ticket-replies'.time().".zip";
            $full_path = public_path('tickets');
            if (count($ticket->file) >1 )
            {
                $zip = new ZipArchive;
                if ($zip->open($full_path .'/'. $archiveName, ZipArchive::CREATE) === TRUE) {
                    foreach ($ticket->file as $file_name) {
                        $isFile =  \File::isFile($full_path.'/files/replies/'.$file_name);
                        if($isFile){
                            $filePath = public_path('tickets/files/replies/'.$file_name);
                            $zip->addFile($filePath,$file_name);
                        }
                    }
                    $zip->close();
                }
                return response()->download($full_path."/".$archiveName)->deleteFileAfterSend(true);
            }else
                return response()->download($full_path.'/files/replies/'.$ticket->file[0]);

        }

    }

}
