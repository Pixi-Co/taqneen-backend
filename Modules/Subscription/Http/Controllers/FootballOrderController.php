<?php

namespace Modules\Subscription\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Subscription\Entities\ClassType;
use Modules\Subscription\Entities\FootballOrder;
use Yajra\DataTables\Facades\DataTables;

class FootballOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id'); 

            $query = FootballOrder::where('business_id', $business_id);

            return DataTables::of($query)
                ->editColumn(
                    'class_type_id',
                    function ($row) {
                        return optional($row->classType)->name;
                    }
                )  
                ->editColumn(
                    'contact_id',
                    function ($row) {
                        return optional($row->contact)->name;
                    }
                ) 
                ->addColumn('action',  function(FootballOrder $football_order){
                    return view("subscription::football_order.action", compact("football_order"));
                })    
                ->removeColumn('id')
                ->rawColumns(['action', 'totals'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function save(Request $request)
    {
        $business_id = request()->session()->get('user.business_id');
        $data = $request->all();
        $data['business_id'] = $business_id; 
        $data['class_type_id'] = optional(ClassType::activeQuery()->where('type', 'football')->first())->id; 

        if ($request->id) {
            $resource = FootballOrder::find($request->id);

            $resource->update($data);
        } else {
            
            if (FootballOrder::ifBooked(request()->start_time, request()->end_time, request()->date)) {
                return responseJson(0, __('time is already booked'));
            }

            $resource = FootballOrder::create($data); 
        }

        return responseJson(1, __('done'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }
 

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $resource  = FootballOrder::find($id);
        $resource->delete();

        return responseJson(1, __('football order removed'));
    }
}
