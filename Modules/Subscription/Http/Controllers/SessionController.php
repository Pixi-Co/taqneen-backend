<?php

namespace Modules\Subscription\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Subscription\Entities\Session;
use Yajra\DataTables\DataTables;
use DB; 
use Illuminate\Support\Facades\Hash;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    { 

        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id'); 

            $sessions = Session::where('business_id', $business_id);

            return DataTables::of($sessions)
                ->editColumn(
                    'class_type_id',
                    function ($row) {
                        return optional($row->classType)->name;
                    }
                )  
                ->editColumn(
                    'trainer_id',
                    function ($row) {
                        return optional($row->trainer)->full_name;
                    }
                )
                ->editColumn(
                    'customer_group_id',
                    function ($row) {
                        return optional($row->customerGroup)->name;
                    }
                )    
                ->addColumn('action',  function(Session $session){
                    return view("subscription::session.action", compact("session"));
                })  
                ->addColumn('totals',  function(Session $session){
                    $html = "";
                    $html .= "<span class='label w3-green' style='margin: 3px' >".$session->members()->count(). " " . __('members') . "</span>"; 
                    $html .= "<span class='label w3-deep-orange' style='margin: 3px' >".($session->group_number - $session->members()->count()). " " . __('embty place') . "</span>"; 
                    return $html;
                }) 
                ->removeColumn('id')
                ->rawColumns(['action', 'totals'])
                ->make(true);
        }

        return view('subscription::index');
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

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $business_id = request()->session()->get('user.business_id');
        $data = $request->all();
        $data['business_id'] = $business_id; 
        
        $resource = DB::table('sub_session')->insert($data);
        //$resource = Session::create($data);

        return responseJson(1, __('done'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $data = $request->all();  
        $resource = Session::find($request->id);
        $resource->update($data);

        return responseJson(1, __('done'));
    }
 
    /**
     * show the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $resource  = Session::with(['trainer', 'classType'])->where('id', $id)->first();
        
        $resource->members = $resource->members();

        return $resource;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $resource  = Session::find($id);
        $resource->delete();

        return responseJson(1, __('session removed'));
    }
}
