<?php

namespace Modules\Subscription\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Subscription\Entities\Rate;
use Yajra\DataTables\DataTables;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Subscription\Entities\UserRate; 

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    { 

        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id'); 

            $rates = Rate::where('business_id', $business_id);

            return DataTables::of($rates) 
                ->addColumn('action',  function(Rate $rate){
                    return view("subscription::rate.action", compact("rate"));
                })
                ->editColumn('active',  function(Rate $rate){
                    return $rate->active == 1? '<span class="label w3-green" >'.__('on').'</span>' : '<span class="label w3-gray" >'.__('off').'</span>';
                }) 
                ->addColumn('rate',  function(Rate $rate){
                    return number_format($rate->rate, 1) . " <i class='fas fa fa-star w3-text-green' ></i>";
                }) 
                ->rawColumns(['action', 'rate', 'active'])
                ->make(true);
        }

        return view('subscription::index');
    }

    public function multirate() {
        return view("subscription::rate.multi_rate");
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
        $data = [
            "name" => $request->name,
            "description" => $request->description, 
            "code" => randToken(), 
            "business_id" => $business_id,
            "active" => $request->active,
        ];

        $resource = DB::table('sub_rates')->insert($data);
        //$resource = Rate::create($data);

        return responseJson(1, __('done'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $data = [
            "name" => $request->name,
            "active" => $request->active,
            "description" => $request->description   
        ];
 
        $resource = Rate::find($request->id);
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
        $rater = Rate::where("code", $id)->first(); 
        $rate = UserRate::where('ip', $request->ip()) 
                    ->where('rate_id', $rater->id)
                    ->where('user_id', optional(Auth::user())->id)
                    ->first();
 
        return view("subscription::rate.rate_page", compact("rate", "rater"));
    }

    public function postRate(Request $request, $id) {
        try { 
            $rate = Rate::find($id); 

            UserRate::where('ip', $request->ip())
                ->where('user_id', optional(Auth::user())->id)
                ->where('rate_id', $rate->id)
                ->delete();

            UserRate::create([ 
                "rate_id" => $rate->id,
                "ip" => $request->ip(),
                "comment" => $request->comment,
                "user_id" => optional(Auth::user())->id, 
                "rate" => request()->rate
            ]);  

            return responseJson(1, __("rate has been rated"));
        } catch (\Exception $th) {
            return responseJson(0, $th->getMessage());
        }
    }

    public function postMultirate(Request $request) {
        try { 
            $rates = json_decode($request->rates);
 
            foreach($rates as $key => $value) {
                if ($value->rate > 0) {
                    $rate = Rate::find($key); 

                    UserRate::where('ip', $request->ip())
                        ->where('user_id', optional(Auth::user())->id)
                        ->where('rate_id', $rate->id)
                        ->delete();
        
                    UserRate::create([ 
                        "rate_id" => $rate->id,
                        "ip" => $request->ip(),
                        "comment" => $value->comment,
                        "user_id" => optional(Auth::user())->id, 
                        "rate" => $value->rate
                    ]);  
                }
            }

            return responseJson(1, __("rate has been rated"));
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
        $rate  = Rate::find($id);

        return view("subscription::rate.profile", compact("rate"));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $resource  = Rate::find($id);
        $resource->delete();

        return responseJson(1, __('class type removed'));
    }
}
