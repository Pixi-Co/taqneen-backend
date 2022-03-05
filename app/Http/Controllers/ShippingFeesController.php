<?php

namespace App\Http\Controllers;

use App\Area;
use App\Brands;
use App\ShippingFees;
use App\ShippingCompany;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class ShippingFeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($company_id)
    {
        if (request()->ajax()) {

            $fees = ShippingFees::with(['area'])->whereHas('company', function($query){
                        $query->where('business_id', request()->session()->get('user.business_id'));
                    })->where('shipping_company_id', $company_id);

            return Datatables::of($fees)
                    ->addColumn('zone_name', function ($row) {
                        return $row->area->name;
                    })
                    ->addColumn(
                        'action',
                        '@can("customer.update")
                            <button data-href="{{action(\'ShippingFeesController@edit\', [\'company\' => $shipping_company_id, \'id\' => $id])}}" class="btn btn-xs btn-primary edit_shipping_fees_button"><i class="glyphicon glyphicon-edit"></i> @trans("messages.edit")</button>
                        &nbsp;
                        @endcan

                        @can("customer.delete")
                            <button data-href="{{action(\'ShippingFeesController@destroy\', [\'company\' => $shipping_company_id, \'id\' => $id])}}" class="btn btn-xs btn-danger delete_customer_group_button"><i class="glyphicon glyphicon-trash"></i> @trans("messages.delete")</button>
                        @endcan'
                    )
                    ->removeColumn(['area'])
                    ->rawColumns(['zone_name', 'action'])
                    ->make(true);
        }

        return view('shipping_company.fees.index', compact('company_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company_id)
    {
        $query = Area::all();
        $areas = $query->pluck('name', 'id');

        return view('shipping_company.fees.create', compact('company_id', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $company_id)
    {
        try {
            $company = ShippingCompany::find($company_id);

            $company->fees()->create([
                'area_id' => $request->get('area_id'),
                'amount' => $request->get('amount'),
            ]);

            $output = ['success' => true,
                'data' => [],
                'msg' => __("lang_v1.success")
            ];
        } catch (\Exception $e) {

            Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());   
            $output = ['success' => false,
                        'msg' => __("messages.something_went_wrong")
                    ];
        }
        return $output;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $company_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($company_id, $id)
    {
        $query = Area::all();
        $areas = $query->pluck('name', 'id');
        $fees = ShippingFees::find($id);

        return view('shipping_company.fees.edit', compact('company_id', 'areas', 'fees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $company_id, $id)
    {
        try {
            $fees = ShippingFees::find($id);

            $fees->update([
                'area_id' => $request->get('area_id'),
                'amount' => $request->get('amount'),
            ]);
            $output = ['success' => true,
                    'data' => [],
                    'msg' => __("lang_v1.success")
                ];
        } catch (\Exception $e) {

            Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());   
            $output = ['success' => false,
                        'msg' => __("messages.something_went_wrong")
                    ];
        }

        return $output;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($company_id, $id)
    {
        try{
            $fees = ShippingFees::find($id);
            $fees->delete();

            $output = ['success' => true,
            'msg' => __("lang_v1.success")
            ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());

            $output = ['success' => false,
                    'msg' => __("messages.something_went_wrong")
                ];
        }

        return $output;
    } 
    public function getDeliveryFees($company_id, $area_id)
    {
        try{
            $fees = ShippingFees::where('shipping_company_id', $company_id)->where('area_id', $area_id)->first();

            $output = ['success' => true,
                        'amount' => $fees->amount,
                        'msg' => __("lang_v1.success")
                    ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());

            $output = ['success' => false,
                    'msg' => __("messages.something_went_wrong")
                ];
        }

        return $output;
    }
}
