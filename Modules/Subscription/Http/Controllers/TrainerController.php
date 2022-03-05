<?php

namespace Modules\Subscription\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Subscription\Entities\Trainer;
use Yajra\DataTables\DataTables;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Subscription\Entities\TrainerRate;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if (!auth()->user()->can('user.view') && !auth()->user()->can('user.create')) {
            abort(403, 'Unauthorized action.');
        } 

        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');
            $user_id = request()->session()->get('user.id');

            $users = Trainer::where('business_id', $business_id) 
                        ->where('is_trainer', '1') 
                        ->select([
                            '*',  
                            DB::raw("CONCAT(COALESCE(surname, ''), ' ', COALESCE(first_name, ''), ' ', COALESCE(last_name, '')) as full_name"), 'email', 'allow_login']);

            return DataTables::of($users)
                ->editColumn('username', '{{$username}} @if(empty($allow_login)) <span class="label bg-gray">@trans("lang_v1.login_not_allowed")</span>@endif')
                ->editColumn(
                    'class_type_ids',

                    function ($row) {  
                        return $row->class_type_names;
                    }
                )  
                ->addColumn('action',  function(Trainer $trainer){
                    return view("subscription::trainer.action", compact("trainer"));
                })
                ->addColumn('rate',  function(Trainer $trainer){
                    return number_format($trainer->rate, 1) . " <i class='fa fa-star w3-text-green' ></i>";
                })
                ->addColumn('contacts',  function(Trainer $trainer){
                    return view("layouts.partials.share", ["phone" => $trainer->phone, "email" => $trainer->email]);
                })
                ->filterColumn('full_name', function ($query, $keyword) {
                    $query->whereRaw("CONCAT(COALESCE(surname, ''), ' ', COALESCE(first_name, ''), ' ', COALESCE(last_name, '')) like ?", ["%{$keyword}%"]);
                })
                ->removeColumn('id')
                ->rawColumns(['action', 'username', 'rate', 'class_type_ids'])
                ->make(true);
        }

        return view('subscription::index');
    }

    public function ratePage() {
        return view("subscription::trainer.rate_page");
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function save(Request $request)
    {
        if ($request->id) {
            return $this->update($request);
        } else { 
            return $this->store($request);
        } 
    }

    public function checkIn($id) {
        try {
            $trainer = Trainer::find($id);
            $business_id = request()->session()->get('user.business_id');
 

            return responseJson(1, __("trainer has been check in"), [
                "member" => [
                    "id" => $trainer->id,
                    "name" => $trainer->full_name,
                ],
                "time" => date('H:i:s')
            ]);
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $business_id = request()->session()->get('user.business_id');
        $classIds = $request->class_type_ids;
        $data = [
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "class_type_ids" => $classIds,
            "username" => $request->username . "-" . $business_id,
            "password" => Hash::make($request->password),
            "email" => $request->email,
            "address" => $request->address,
            "status" => $request->status,
            "business_id" => $business_id,
            "salary" => $request->salary,
            "profit_percent" => $request->profit_percent,
            "is_trainer" => '1',
            "user_type" => 'trainer',
        ];

        $resource = DB::table('users')->insert($data);
        //$resource = Trainer::create($data);

        return responseJson(1, __('done'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $classIds = $request->class_type_ids;
        $data = [
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "class_type_ids" => $classIds,
            "username" => $request->username, 
            "email" => $request->email,
            "address" => $request->address,
            "status" => $request->status, 
            "salary" => $request->salary,
            "profit_percent" => $request->profit_percent,
            "is_trainer" => '1'
        ];

        if ($request->password)
            $data['password'] = Hash::make($request->password);

        $resource = Trainer::find($request->id);
        $resource->update($data);

        return responseJson(1, __('done'));
    }
 

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function rate(Request $request, $id)
    {
        $trainer = Trainer::where("remember_token", $id)->first(); 
        $rate = TrainerRate::where('ip', $request->ip())
        ->where('date', date('Y-m-d'))
        ->where('trainer_id', $trainer->id)->first();
 
        return view("subscription::trainer.rate_page", compact("trainer", "rate"));
    }

    public function postRate(Request $request, $id) {
        try { 
            $trainer = Trainer::find($id); 

            TrainerRate::where('ip', $request->ip())
            ->where('date', date('Y-m-d'))
            ->where('trainer_id', $trainer->id)->delete();

            TrainerRate::create([
                "trainer_id" => $trainer->id,
                "ip" => $request->ip(),
                "comment" => $request->comment,
                "user" => optional(Auth::user())->first_name . " " . optional(Auth::user())->last_name,
                "date" => date('Y-m-d'),
                "rate" => request()->rate
            ]);  

            return responseJson(1, __("trainer has been rated"));
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
    }
 
    /**
     * show the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $trainer  = Trainer::find($id);

        return view("subscription::trainer.profile", compact("trainer"));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $resource  = Trainer::find($id);
        $resource->delete();

        return responseJson(1, __('class type removed'));
    }
}
