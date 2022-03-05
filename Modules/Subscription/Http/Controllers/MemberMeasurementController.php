<?php

namespace Modules\Subscription\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Subscription\Entities\MemberMeasurement; 

class MemberMeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $business_id = request()->session()->get('user.business_id');
        return MemberMeasurement::where('business_id', $business_id)->get();
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function save(Request $request)
    {
        $business_id = request()->session()->get('user.business_id');
        $data = $request->all();
        $data['date'] = date('Y-m-d'); 

        if ($request->id) {
            $resource = MemberMeasurement::find($request->id);

            $resource->update($data);
        } else {
            $resource = MemberMeasurement::create($data); 
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
        $resource  = MemberMeasurement::find($id);
        $resource->delete();

        return responseJson(1, __('measurment removed'));
    }
}
