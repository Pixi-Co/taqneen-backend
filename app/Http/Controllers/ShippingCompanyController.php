<?php

namespace App\Http\Controllers;

use App\ShippingCompany;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class ShippingCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $business_id = request()->session()->get('user.business_id');
 
        $companies = ShippingCompany::where('business_id', $business_id)->get();

        return view('shipping_company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('shipping_company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $input = $request->only(['name', 'logo']);
            $input['business_id'] = $request->session()->get('user.business_id');
            $input['created_by'] = $request->session()->get('user.id');

            $company = ShippingCompany::create($input);

            // Media::uploadMedia($company->business_id, $company, $request, 'product_brochure', true);
            $output = ['success' => true,
                'data' => $company,
                'msg' => __("lang_v1.success")
            ];

        } catch (\Exception $e) {
            Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());   
            $output = ['success' => false,
                            'msg' => __("messages.something_went_wrong")
                        ];
        }
        return redirect()->action('\App\Http\Controllers\ShippingCompanyController@index')->with('status', $output);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|Response|View
     */
    public function edit($id)
    {
        if (!auth()->user()->can('customer.update')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');
            $company = ShippingCompany::where('business_id', $business_id)->find($id);

            return view('shipping_company.edit')
                ->with(compact('company'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('customer.update')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            try {
                $input = $request->only(['name', 'logo']);
                $business_id = $request->session()->get('user.business_id');
                $input['created_by'] = $request->session()->get('user.id');

                $company = ShippingCompany::where('business_id', $business_id)->findOrFail($id);

                $company->update($input);

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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
