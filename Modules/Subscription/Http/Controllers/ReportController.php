<?php

namespace Modules\Subscription\Http\Controllers;

use App\Business;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Subscription\Entities\Trainer;
use Yajra\DataTables\DataTables;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Subscription\Entities\Attandance;
use Modules\Subscription\Entities\MemberMeasurement;
use Modules\Subscription\Entities\Rate;
use Modules\Subscription\Entities\Session;
use Modules\Subscription\Entities\Subscription;
use Modules\Subscription\Entities\UserRate;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function attendance()
    {
        if (!auth()->user()->can('subscription.report.attendances')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {

            $business_id = request()->session()->get('user.business_id');

            $query = Attandance::where('business_id', $business_id);

            if (request()->start_date && request()->end_date) {
                $query->whereBetween('date', [request()->start_date, request()->end_date]);
            }

            if (request()->member_id > 0)
                $query->where('member_id', request()->member_id);

            if (request()->session_id > 0)
                $query->where('session_id', request()->session_id);

            return Datatables::of($query)
                ->editColumn('member_id', function (Attandance $row) {
                    return optional($row->member)->name;
                }) 
                ->editColumn('session_id', function (Attandance $row) {
                    return optional($row->session)->name;
                }) 
                ->editColumn('created_at', function (Attandance $row) {
                    return date('H:i:s', strtotime($row->created_at));
                }) 
                ->rawColumns([''])
                ->make(true);
        }

        return view('subscription::report.attandance');
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function trainer()
    {
        if (!auth()->user()->can('subscription.report.trainers')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {

            $business_id = request()->session()->get('user.business_id');

            $query = Trainer::where('business_id', $business_id)->where('is_trainer', '1');

            if (request()->start_date && request()->end_date && (request()->start_date != date('Y-m-d') && request()->end_date != date('Y-m-d'))) {
                $query->whereBetween('created_at', [request()->start_date . " 00:00:00", request()->end_date . " 00:00:00"]);
            }

            if (request()->trainer_id > 0)
                $query->where('id', request()->trainer_id);

            //if (request()->session_id > 0)
            //    $query->where('session_id', request()->session_id);

            return Datatables::of($query)
                ->addColumn('qrcode', function (Trainer $row) {
                    return "<a  href='#'><div class='qrcode' onclick='viewQrcode(\"".$row->rate_link."\")' data-text='".$row->rate_link."' data-width='40' data-height='40' ></div></a>";
                })
                ->addColumn('rate_count', function (Trainer $row) {
                    return $row->rates()->count();
                })
                ->addColumn('rate_avg', function (Trainer $row) {
                    return number_format($row->rate, 1);
                })
                ->addColumn('member_count', function (Trainer $row) {
                    return $row->members()->count();
                })
                ->addColumn('session_count', function (Trainer $row) {
                    return $row->sessions()->count();
                })
                ->addColumn('session_names', function (Trainer $row) {
                    return implode(",", $row->sessions()->pluck('name')->toArray());
                })
                ->editColumn('class_type_ids', function (Trainer $row) {
                    return $row->class_type_names;
                })  
                ->editColumn('created_at', function (Trainer $row) {
                    return date('Y-m-d H:i:s', strtotime($row->created_at));
                }) 
                ->rawColumns(['qrcode'])
                ->make(true);
        }

        return view('subscription::report.trainer');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function subscription()
    {
        if (!auth()->user()->can('subscription.report.subscriptions') && !auth()->user()->can('subscription.view')) {
            abort(403, 'Unauthorized action.');
        }
        
        if (request()->ajax()) {

            $business_id = request()->session()->get('user.business_id');
            $business = Business::find($business_id);

            $query = Subscription::join('transaction_sell_lines', 'transaction_id', '=', 'transactions.id')
                ->select(
                    '*',
                    'transaction_sell_lines.id as id',
                    'transaction_sell_lines.is_expire as is_expire',
                    'transaction_sell_lines.class_type_id as class_type_id', 
                    DB::raw('(select name from products where products.id = product_id) as product_name'),
                    DB::raw('(transaction_sell_lines.unit_price * transaction_sell_lines.quantity) as final_total')
                )
                ->where('business_id', $business_id)
                ->where('type', 'sell')
                ->where('is_subscription', '1');
 

            if (request()->start_date && request()->end_date) {
                $query->whereBetween('transaction_date', [request()->start_date, request()->end_date]);
            }

            if (request()->member_id > 0)
                $query->where('contact_id', request()->member_id);

            if (request()->class_type_id > 0)
                $query->where('class_type_id', request()->class_type_id);

            if (request()->payment_status > 0)
                $query->where('payment_status', request()->payment_status);

            if (request()->session_id > 0)
                $query->where('session_id', request()->session_id);

            if (request()->is_expire)
                $query->where('transaction_sell_lines.is_expire', request()->is_expire);

            return Datatables::of($query)
                ->editColumn('contact_id', function (Subscription $row) {
                    return optional($row->member)->name;
                }) 
                ->addColumn('session', function (Subscription $row) {
                    return optional(optional($row->member)->sessionsQuery()->first())->name;
                }) 
                ->editColumn('product_id', function (Subscription $row) {
                    return $row->product_name;
                }) 
                ->editColumn('class_type_id', function (Subscription $row) {
                    return optional($row->classType)->name;
                })
                ->editColumn('created_at', function (Subscription $row) {
                    return date('Y-m-d H:i:s', strtotime($row->created_at));
                })
                ->editColumn('is_expire', function (Subscription $row) {
                    return $row->is_expire? '<span class="w3-large label w3-red" >'.__('expired').'</span>' : '<span class="w3-large label w3-green" >'.__('active').'</span>';
                }) 
                ->editColumn('final_total', function (Subscription $row) use ($business) {
                    return "<span class='display_currency' >".$row->final_total . "</span> " . optional($business->currency)->symbol;
                }) 
                ->editColumn('is_stop', function (Subscription $row) {
                    return $row->is_stop == '1'? '<span class="w3-large label w3-red" >'.__('stoped').'</span>' : '<span class="w3-large label w3-green" >'.__('active').'</span>';
                 }) 
                ->addColumn('contacts', function (Subscription $row) {
                    return view("layouts.partials.share", ["phone" => optional($row->member)->mobile, "email" => optional($row->member)->email]);
                }) 
                ->addColumn('actions', function (Subscription $row) {
                    return view("subscription::subscription.actions", ["subscription" => $row]);
                }) 
                ->rawColumns(['final_total', 'is_expire', 'is_stop', 'actions'])
                ->make(true);
        }

        return view('subscription::report.subscription');
    }
    
    /**
     * Display a measurements of members.
     * @return Response
     */
    public function measurement()
    {
 
        if (!auth()->user()->can('subscription.report.measurements')) {
            abort(403, 'Unauthorized action.');
        }
        
        $resource = MemberMeasurement::getChartData();
 
        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');
            $ids = DB::table('contacts')->select('id')->where('business_id', $business_id)->pluck('id')->toArray();

            $query = MemberMeasurement::whereIn('member_id', $ids);

            if (request()->start_date && request()->end_date) {
                $query->whereBetween('date', [request()->start_date, request()->end_date]);
            }

            if (request()->member_id > 0)
                $query->where('member_id', request()->member_id);

            if (request()->measurement_id > 0)
                $query->where('measurement_id', request()->measurement_id);
 
            return Datatables::of($query)  
                ->editColumn('member_id', function (MemberMeasurement $row) {
                    return optional($row->member)->name;
                })   
                ->editColumn('measurement_id', function (MemberMeasurement $row) {
                    return optional($row->meassurement)->name;
                })   
                ->rawColumns(['member_id'])
                ->make(true);
        }

        return view('subscription::report.measurement', compact("resource"));
    }
    
    /**
     * Display a rates.
     * @return Response
     */
    public function rates()
    {

        if (!auth()->user()->can('subscription.report.rates')) {
            abort(403, 'Unauthorized action.');
        }
        
        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');
            $ids = DB::table('sub_rates')->select('id')->where('business_id', $business_id)->pluck('id')->toArray();
 
            $query = UserRate::whereIn('rate_id', $ids);

            if (request()->start_date && request()->end_date) {
               //$query->whereBetween('created_at', [request()->start_date . " 01:00:00", request()->end_date . " 24:00:00"]);
            }

            if (request()->rate_id > 0)
                $query->where('rate_id', request()->rate_id);

            if (request()->user_id > 0)
                $query->where('user_id', request()->user_id);

            if (request()->rate > 0)
                $query->where('rate', request()->rate);

            return Datatables::of($query)  
                ->editColumn('user_id', function (UserRate $row) {
                    return optional($row->user()->first())->first_name;
                }) 
                ->editColumn('rate_id', function (UserRate $row) {
                    return optional($row->rate()->first())->name;
                }) 
                ->editColumn('rate',  function(UserRate $rate){
                    return number_format($rate->rate, 1) . " <i class='fas fa fa-star w3-text-green' ></i>";
                })     
                ->rawColumns(['rate'])
                ->make(true);
        }

        return view('subscription::report.rate');
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function trainerPercent()
    {
        if (!auth()->user()->can('subscription.report.trainer_percents')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {

            $business_id = request()->session()->get('user.business_id');

            $query = Trainer::where('business_id', $business_id)->where('is_trainer', '1');

            if (request()->start_date && request()->end_date && (request()->start_date != date('Y-m-d') && request()->end_date != date('Y-m-d'))) {
                $query->whereBetween('created_at', [request()->start_date . " 00:00:00", request()->end_date . " 00:00:00"]);
            }

            if (request()->trainer_id > 0)
                $query->where('id', request()->trainer_id);

            //if (request()->session_id > 0)
            //    $query->where('session_id', request()->session_id);

            return Datatables::of($query)
                ->addColumn('qrcode', function (Trainer $row) {
                    return "<a  href='#'><div class='qrcode' onclick='viewQrcode(\"".$row->rate_link."\")' data-text='".$row->rate_link."' data-width='40' data-height='40' ></div></a>";
                })
                ->addColumn('rate_count', function (Trainer $row) {
                    return $row->rates()->count();
                })
                ->addColumn('rate_avg', function (Trainer $row) {
                    return number_format($row->rate, 1);
                })
                ->editColumn('first_name', function (Trainer $row) {
                    return implode(" ", [$row->first_name, $row->last_name]);
                })
                ->addColumn('member_count', function (Trainer $row) {
                    return $row->members()->count();
                })
                ->addColumn('session_count', function (Trainer $row) {
                    return $row->sessions()->count();
                })
                ->addColumn('subscription_count', function (Trainer $row) {
                    $ids = $row->sessions()->pluck('id')->toArray();
                    $subCount = Subscription::activeQuery()
                        ->where('is_expire', '1')
                        ->whereIn('session_id', $ids)
                        ->count();

                    return $subCount;
                })
                ->addColumn('subscription_percent', function (Trainer $row) {
                    if ($row->profit_percent <= 0)
                        return 0;
                    $ids = $row->sessions()->pluck('id')->toArray();
                    $subSum = Subscription::activeQuery()
                        ->where('is_expire', '1')
                        ->whereIn('session_id', $ids)
                        ->sum(DB::raw('(transaction_sell_lines.unit_price * transaction_sell_lines.quantity)'));

                    return ($row->profit_percent / 100) * $subSum;
                })
                ->addColumn('session_names', function (Trainer $row) {
                    return implode(",", $row->sessions()->pluck('name')->toArray());
                })
                ->editColumn('class_type_ids', function (Trainer $row) {
                    return $row->class_type_names;
                })  
                ->editColumn('created_at', function (Trainer $row) {
                    return date('Y-m-d H:i:s', strtotime($row->created_at));
                }) 
                ->rawColumns(['qrcode'])
                ->make(true);
        }

        return view('subscription::report.trainer_percent');
    }
}
