<?php

namespace Modules\Subscription\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Subscription\Entities\Measurement; 

class MeasurmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $business_id = request()->session()->get('user.business_id');
        return Measurement::where('business_id', $business_id)->get();
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

        if ($request->id) {
            $resource = Measurement::find($request->id);

            $resource->update($data);
        } else {
            $resource = Measurement::create($data); 
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
        $resource  = Measurement::find($id);
        $resource->delete();

        return responseJson(1, __('measurment removed'));
    }
}
