<?php

namespace App\Http\Controllers\taqneen;

use App\CannedReply;
use App\DepartmentUser;
use App\Http\Resources\TicketResource;
use App\Ticket;
use App\TicketDepartment;
use App\TicketPriority;
use App\TicketReply;
use App\TicketStatus;
use App\User;
use App\Utils\Util;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class TicketController extends Controller
{

    protected $commonUtil;

    public function __construct(Util $commonUtil)
    {
        $this->commonUtil = $commonUtil;
    }
    public function index()
    {
        $is_admin = $this->commonUtil->is_admin(auth()->user());
        $tickets = Ticket::query();
        if (!$is_admin) {
            $tickets =  $tickets->where('user_id',auth()->id())->with(['user','agent','department','status'])->get();
        }else
            $tickets =  $tickets->with(['user','agent','department','priority','status'])->get();

        $tickets = collect(TicketResource::collection($tickets));
        return view('taqneen.ticket.index',compact('tickets'));
    }


    public function create()
    {
        $departments = TicketDepartment::all();
        $mainDepartments = $departments->where('parent_id',null);
        $subDepartments =$departments->where('parent_id','!==',null);
        return view('taqneen.ticket.create',compact('mainDepartments','subDepartments'));
    }

    public function store(Request $request)
    {
        try {
            $priority_id = $this->getTicketPriorty($request->sub_department);
            $user_id = $this->getAssignedUser($request->sub_department);
            $status_id = $this->getDefaultTicketStatus();
            $data = [
                "agent_id"=>auth()->user()->id,
                'user_id'=>$user_id,
                'priority_id'=>$priority_id,
                'status_id'=>$status_id,
                'description'=>$request->description,
                'department_id'=>$request->sub_department
            ];
            if($request->file('file')) {
                $file = $request->file('file');
                $filename = time().'_'.$file->getClientOriginalName();
                // File upload location
                $location = 'tickets/files';
                // Upload file
                $file->move($location,$filename);
                $data['file'] = $filename;
            }

            $created = Ticket::create($data);
            if ($created)
                $output = [
                    "success" => 1,
                    "msg" => __('done')
                ];
            else
                $output = [
                    "success" => 0,
                    "msg" => __('fail')
                ];
            return redirect()->route('tickets')->with('status', $output);

        }catch (\Exception $th)
        {
            DB::rollBack();
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];
            return back()->with('status', $output);
        }

    }
    public function show($id)
    {
        $auth_user = auth()->user();
        $ticket = Ticket::with(['user','agent','department','priority','status'])->findOrFail($id);
        $ticket = $this->prepareTicketData($ticket);
        $cannedReplies = CannedReply::all();
        $ticketStatuses = TicketStatus::all();
        $ticketsReplies = TicketReply::where('ticket_id',$ticket['id'])->with('user')->latest()->get();
        $users = User::limit(70)->get();
        return view('taqneen.ticket.show',compact('ticket','cannedReplies','ticketStatuses','users','ticketsReplies','auth_user'));
    }

    public function edit($id)
    {

    }

    public function update(Request $request,$id)
    {

    }

    public function activateAll($id)
    {
        DepartmentUser::where('ticket_id',$id)->update(['is_active'=>1]);
        $output = [
            "success" => 1,
            "msg" => __('done')
        ];
        return back()->with('status', $output);
    }

    public function deactivateAll($id)
    {
        DepartmentUser::where('ticket_id',$id)->update(['is_active'=>0]);
        $output = [
            "success" => 1,
            "msg" => __('done')
        ];
        return back()->with('status', $output);
    }

    public function status($id)
    {
        $departmentUser = DepartmentUser::findOrFail($id);
        $is_active = $departmentUser->is_active==1?0:1;
        $departmentUser->update(['is_active'=>$is_active]);
        $output = [
            "success" => 1,
            "msg" => __('done')
        ];
        return back()->with('status', $output);
    }

    public function delateAllForDepartment($id)
    {
        DepartmentUser::where('ticket_id',$id)->delete();
        return responseJson(1, __('done'));

    }

    public function destory($id)
    {
        $departmentUser = DepartmentUser::findOrFail($id);
        $departmentUser->delete();
        return responseJson(1, __('done'));
    }


    private function getAssignedUser($department_id)
    {
        $users = DepartmentUser::where('department_id',$department_id)->pluck('user_id');
       if ($users)
       {
           $usersTicketsCount = DB::table('tickets')->whereIn('user_id',$users)->select('user_id',DB::raw('count("id") as tickets_count'))->groupBy('user_id')->get();
           $usersTicketsCount = $usersTicketsCount->sortBy('tickets_count');
           if (count($usersTicketsCount))
               return $usersTicketsCount->first()->user_id;
           return $users->first();
       }

    }

    private function getTicketPriorty($department_id)
    {
        $priority =  DB::table('ticket_departments')->where('ticket_departments.id',$department_id)->join('ticket_priorities','ticket_departments.priority_id','=','ticket_priorities.id')->select(['ticket_priorities.id as priority_id'])->first();
        if ($priority)
            return $priority->priority_id;
        return TicketPriority::first()->id;
    }

    private function getDefaultTicketStatus()
    {
       $defaultStatus =  TicketStatus::where('is_default',1)->first();
       if ($defaultStatus)
           return $defaultStatus->id;
       else
           return TicketStatus::first()->id;
    }

    public function changeTicketUser(Request $request)
    {
        $request->validate(['ticket_id'=>'required','user_id'=>'required']);
        $ticket = Ticket::findOrFail($request->ticket_id);
        if ($ticket->user_id!=$request->user_id)
            $ticket->update(['user_id'=>$request->user_id]);
        $output = [
            "success" => 1,
            "msg" => __('done')
        ];
        return back()->with('status', $output);
    }

    public function changeTicketStatus($ticket_id,$status_id)
    {
        //check if staus already exists
        $status = TicketStatus::findOrFail($status_id);
        $ticket = Ticket::findOrFail($ticket_id);
        $ticket->update(['status_id'=>$status->id]);
        $output = [
            "success" => 1,
            "msg" => __('done')
        ];
        return back()->with('status', $output);
    }

    public function prepareTicketData($ticket)
    {
        return [
            "id"=>$ticket->id,
            "title"=>$ticket->department->name,
            "sub_department_id"=>$ticket->department->id,
            "department"=>$ticket->department->department->name,
            "description"=>$ticket->description,
            "customer"=>$ticket->agent->full_name,
            "customer_email"=>$ticket->agent->email,
            "status"=>$ticket->status->name,
            "priority"=>$ticket->priority->name,
            "priority_color"=>$ticket->priority->color,
            "user"=>$ticket->user->full_name,
            "created_at"=>$ticket->created_at->diffForHumans(),
        ];
    }
}
