<?php

namespace App\Http\Controllers\taqneen;

use App\CannedReply;
use App\Contact;
use App\DepartmentUser;
use App\EmailTemplate;
use App\Enum\UserType;
use App\Http\Requests\taqneen\TicketRequest;
use App\Http\Resources\TicketResource;
use App\Ticket;
use App\TicketDepartment;
use App\TicketPriority;
use App\TicketReply;
use App\TicketStatus;
use App\Triger;
use App\User;
use App\Utils\Util;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class TicketController extends Controller
{

    protected $commonUtil;

    public function __construct(Util $commonUtil)
    {
        $this->commonUtil = $commonUtil;
    }
    public function index(Request $request)
    {
        $subDepartments  = TicketDepartment::whereNotNull('parent_id')->get();
        $priorities = TicketPriority::all();
        $ticketStatues = TicketStatus::all();
        if ($request->ajax()) {
            $data = Ticket::with(['user','agent','department','priority','status'])->select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($ticket) {
                    return view('taqneen.ticket.actions', compact('ticket'));
                })

                ->editColumn('agent.first_name', function ($ticket) {
                    return $ticket->agent->first_name." ". $ticket->agent->last_name??$ticket->client_name;
                })

                ->editColumn('agent.custom_field_1', function ($ticket) {
                    return $ticket->agent->custom_field_1??$ticket->computer_num;
                })

                ->filter(function ($instance) use ($request) {
                    if ($request->get('sub_department') !== null ){
                        $instance->where('department_id', $request->get('sub_department'));
                    }

                    if ($request->get('priority') !== null ){
                        $instance->where('priority_id', $request->get('priority'));
                    }

                    if ($request->get('status') !== null ){
                        $instance->where('status_id', $request->get('status'));
                    }
                    if (!empty($request->get('user_name'))) {
                        $instance->whereHas('user',function($w) use($request){
                            $search = $request->get('user_name');
                            $w->where('first_name', 'LIKE', "%$search%")
                                ->orWhere('last_name', 'LIKE', "%$search%");
                        });
                    }

                    if (!empty($request->get('client_name'))) {
                        $instance->whereHas('agent',function($w) use($request){
                            $search = $request->get('client_name');
                            $w->where('first_name', 'LIKE', "%$search%")
                                ->orWhere('last_name', 'LIKE', "%$search%");
                        });
                    }

                    if (!empty($request->get('computer_num'))) {
                        $instance->whereHas('agent',function($w) use($request){
                            $search = $request->get('computer_num');
                            $w->where('custom_field_1', $search);
                        });
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('taqneen.ticket.index',compact('subDepartments','priorities','ticketStatues'));
    }


    public function create()
    {
        $authedUser = auth()->user()->contactInfo()->get(['id','name','email','custom_field1'])->first();
        $departments = TicketDepartment::all();
        $users = User::where('user_type',UserType::$USERCUSTOMER)->get();
        $mainDepartments = $departments->where('parent_id',null);
        $subDepartments =$departments->where('parent_id','!==',null);
        return view('taqneen.ticket.create',compact('mainDepartments','subDepartments','users','authedUser'));
    }

    public function createGuestTicket()
    {
        $departments = TicketDepartment::all();
        $mainDepartments = $departments->where('parent_id',null);
        $subDepartments =$departments->where('parent_id','!==',null);
        $ip = request()->ip();
        return view('taqneen.ticket.guest-create',compact('mainDepartments','subDepartments','ip'));
    }


    public function store(TicketRequest $request)
    {
        try {
            $priority_id = $this->getTicketPriorty($request->sub_department);
            $user_id = $this->getAssignedUser($request->sub_department);
            $status = $this->getDefaultTicketStatus();
            $agent_id = auth()->check()?auth()->user()->user_type==UserType::$USERCUSTOMER?auth()->user()->id:$request->agent_id:null;
            $data = [
                "agent_id"=>$agent_id,
                'user_id'=>$user_id,
                'priority_id'=>$priority_id,
                'status_id'=>$status->id,
                'description'=>$request->description,
                'department_id'=>$request->sub_department,
                'created_by'=>auth()->user()->id??$agent_id,
            ];
            if($request->file('file')) {
                foreach ($request->file('file') as $file)
                {
                    $filename = time().'_'.$file->getClientOriginalName();
                    // File upload location
                    $location = 'tickets/files';
                    // Upload file
                    $file->move($location,$filename);
                    $data['file'] = $filename;
                }
            }

            $ticket = Ticket::create($data);
            if ($ticket)
            {
                $checkTrigger = $this->checkStatusTrigger(strtoupper($status->name));
                if ($checkTrigger)
                    Triger::fire2(strtoupper($status->name), $ticket);
                $output = [
                    "success" => 1,
                    "msg" => __('done')
                ];
            }
            else
                $output = [
                    "success" => 0,
                    "msg" => __('fail')
                ];
             if (url()->current()==route('tickets.guest.create'))
                 return back()->with('done',__('thank you for sending ticket will reply soon'));
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
        $users = User::where('user_type',UserType::$USERCUSTOMER)->get();
        return view('taqneen.ticket.show',compact('ticket','cannedReplies','ticketStatuses','users','ticketsReplies','auth_user'));
    }

    public function printTicket($id)
    {
        $ticket = Ticket::with(['user','agent','department','priority','status'])->findOrFail($id);
        $ticket = $this->prepareTicketData($ticket);
        $ticketsReplies = TicketReply::where('ticket_id',$ticket['id'])->with('user')->latest()->get();
        return view('taqneen.ticket.print-ticket',compact('ticket','ticketsReplies'));

    }

    public function edit($id)
    {
        $ticket = Ticket::with(['agent'=>function($q){
            $q->select('id','first_name','last_name','email');
        }])->findOrFail($id);
        $departments = TicketDepartment::all();
        $users = User::where('user_type',UserType::$USERCUSTOMER)->get();
        $mainDepartments = $departments->where('parent_id',null);
        $subDepartments =$departments->where('parent_id','!==',null);
        return view('taqneen.ticket.edit',compact('mainDepartments','subDepartments','users','ticket'));

    }

    public function update(Request $request,$id)
    {

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


    private function createUserForGuestByComputerNumber(Request $request)
    {
        try {
            $contact = Contact::firstOrCreate([
                "custom_field1" => $request->computer_num,//computer number
            ],[
                "mobile" => $request->mobile,
                "email" => $request->email,
                "state" => "egypt",
                "name" => 'client'.$request->ip(),
                "business_id" => session('business.id'),
                "created_by" => session('user.id'),
                "type" => 'customer',
            ]);

            $request->roles = "customer#19";
            $user = $this->createOrUpdateUser($contact, $request);
            return $user;
        } catch (\Exception $th) {

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
           return $defaultStatus ;
       else
           return TicketStatus::first();
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
            "customer"=>$ticket->agent->full_name??$ticket->client_name,
            "computer_num"=>$ticket->agent->custom_field_1??$ticket->computer_num,
            "customer_email"=>$ticket->agent->email??$ticket->client_email,
            "status"=>$ticket->status->name,
            "priority"=>$ticket->priority->name,
            "priority_color"=>$ticket->priority->color,
            "user"=>$ticket->user->full_name,
            "created_at"=>$ticket->created_at,
        ];
    }

    public function checkStatusTrigger($status)
    {
        return (boolean) (EmailTemplate::where('template_for',$status)->first());
    }

    public function createOrUpdateUser(Contact $customer, Request $request)
    {
        $user = $customer->loginUser;
        try {

            if ($user) {
                // update
                $data = [
                    "first_name" => $customer->name,
                    "last_name" => $customer->name,
                    "email" => $customer->email,
                    "contact_number" => $request->contact_number,
                    "address" => $request->address_line_1,
                    "password" => bcrypt($request->ip()),
                    'contact_id'=>$customer->id,
                ];

                $user->update($data);
                $user->assignRole("customer");
            } else {
                // create
                $user = User::create([
                    "first_name" => $customer->name,
                    "last_name" => $customer->name,
                    "email" => $customer->email,
                    "password" => bcrypt($request->ip()),
                    "business_id" => session('business.id'),
                    "user_type" => 'user_customer',
                    "custom_field_1" => $customer->custom_field1,
                    "contact_id"=>$customer->id
                ]);
                $user->assignRole("customer");
                $customer->converted_by = $user->id;
                $customer->update();
            }
        } catch (\Exception $th) {
            //throw $th;
        }
        return $user;
    }


}
