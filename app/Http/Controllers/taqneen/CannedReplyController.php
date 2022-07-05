<?php

namespace App\Http\Controllers\taqneen;

use App\CannedReply;
use App\Http\Requests\taqneen\CannedReplyRequest;
use App\Http\Requests\taqneen\TicketStatusRequest;
use App\TicketStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CannedReplyController extends Controller
{
    public function index()
    {
        $cannedReplies = CannedReply::all();
        return view('taqneen.ticket.canned-reply.index',compact('cannedReplies'));
    }


    public function create()
    {
        return view('taqneen.ticket.canned-reply.create');
    }

    public function store(CannedReplyRequest $request)
    {

        try {
            $data = $request->validated();
            CannedReply::create($data);
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
        $cannedReply = CannedReply::findOrFail($id);
        return view('taqneen.ticket.canned-reply.edit',compact('cannedReply'));

    }

    public function update(CannedReplyRequest $request,$id)
    {
        $data =$request->validated();
        $cannedReply =CannedReply::findOrFail($id);
        $updated = $cannedReply->update($data);
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
    return redirect()->route('canned-reply')->with('status', $output);

    }

    public function delete($id)
    {
        $cannedReply = CannedReply::findOrFail($id);
        $cannedReply->delete();
        return responseJson(1, __('done'));
    }

}
