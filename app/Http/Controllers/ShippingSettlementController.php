<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\ShippingCompany;
use Illuminate\Http\Request;
use App\Utils\TransactionUtil;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class ShippingSettlementController extends Controller
{
    /**
     * All Utils instance.
     *
     */
    protected $transactionUtil;

    /**
     * Constructor
     *
     * @param TransactionUtil $transactionUtil
     * @return void
     */
    public function __construct(TransactionUtil $transactionUtil)
    {
        $this->transactionUtil = $transactionUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($company_id)
    {

        if (request()->ajax()) {

            $business_id = request()->session()->get('user.business_id');

            $sells = Transaction::where('business_id', $business_id)
                ->where('shipping_company_id', $company_id);

            return Datatables::of($sells)
                    ->addColumn(
                        'action',
                        '<button data-href="{{action(\'ShippingSettlementController@edit\', [\'company\' => $shipping_company_id, \'id\' => $id])}}" class="btn btn-xs btn-primary settle_shipping_company_button"><i class="glyphicon glyphicon-edit"></i> @trans("messages.settle")</button>'
                    )
                    ->rawColumns(['action'])
                    ->make(true);
        }


        return view('shipping_company.settlement.index', compact('company_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($company_id, $id)
    {
        $sell = Transaction::find($id);
        $shipping_statuses = $this->transactionUtil->shipping_statuses();

        return view('shipping_company.settlement.edit', compact('company_id', 'sell', 'shipping_statuses'));
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
        try{
                $transaction = Transaction::find($id);

                $transaction->update([
                    'payment_status' => 'paid',
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function settleBulk(Request $request)
    {
        try{
            $transaction = Transaction::whereNotNull('shipping_company_id')
                    ->whereIn('id', $request->get('ids'))
                    ->update([
                        'payment_status' => 'paid',
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
    public function destroy($id)
    {
        //
    }
}
