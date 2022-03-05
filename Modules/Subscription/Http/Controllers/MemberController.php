<?php

namespace Modules\Subscription\Http\Controllers;

use App\Business;
use App\TransactionSellLine;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller; 
use Modules\Subscription\Entities\Member; 
use App\Utils\ContactUtil;
use App\Utils\ModuleUtil;
use App\Utils\NotificationUtil;
use App\Utils\TransactionUtil;
use App\Utils\Util;
use DB;
use Modules\Subscription\Entities\Attandance;
use Modules\Subscription\Entities\Session;
use Modules\Subscription\Entities\Subscription;
use Yajra\DataTables\Facades\DataTables;  

class MemberController extends Controller
{ 
    protected $commonUtil;
    protected $contactUtil;
    protected $transactionUtil;
    protected $moduleUtil;
    protected $notificationUtil;

    /**
     * Constructor
     *
     * @param Util $commonUtil
     * @return void
     */
    public function __construct(
        Util $commonUtil,
        ModuleUtil $moduleUtil,
        TransactionUtil $transactionUtil,
        NotificationUtil $notificationUtil,
        ContactUtil $contactUtil
    ) {
        $this->commonUtil = $commonUtil;
        $this->contactUtil = $contactUtil;
        $this->moduleUtil = $moduleUtil;
        $this->transactionUtil = $transactionUtil;
        $this->notificationUtil = $notificationUtil;
    }
    /**
     * Returns the database object for customer
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('customer.view') && !auth()->user()->can('customer.view_own')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');

        $query = $this->contactUtil->getContactQuery($business_id, 'customer');

        $contacts = Datatables::of($query)
            ->addColumn('address', '{{implode(", ", array_filter([$address_line_1, $address_line_2, $city, $state, $country, $zip_code]))}}')
            ->addColumn(
                'due',
                '<span class="contact_due" data-orig-value="{{$total_invoice - $invoice_received}}" data-highlight=true>@format_currency($total_invoice - $invoice_received)</span>'
            )
            ->addColumn(
                'return_due',
                '<span class="return_due" data-orig-value="{{$total_sell_return - $sell_return_paid}}" data-highlight=false>@format_currency($total_sell_return - $sell_return_paid)</span>'
            )
            ->addColumn(
                'action',
                function ($row) {
                    $html = '<div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle btn-xs" 
                        data-toggle="dropdown" aria-expanded="false">' .
                        __("messages.actions") .
                        '<span class="-caret"></span><span class="sr-only">Toggle Dropdown
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-left" role="menu">';

                    $html .= '<li><a href="' . action('TransactionPaymentController@getPayContactDue', [$row->id]) . '?type=sell" class="pay_sale_due"><i class="fas fa-money-bill-alt" aria-hidden="true"></i>' . __("lang_v1.pay") . '</a></li>';
                    $return_due = $row->total_sell_return - $row->sell_return_paid;
                    if ($return_due > 0) {
                        $html .= '<li><a href="' . action('TransactionPaymentController@getPayContactDue', [$row->id]) . '?type=sell_return" class="pay_purchase_due"><i class="fas fa-money-bill-alt" aria-hidden="true"></i>' . __("lang_v1.pay_sell_return_due") . '</a></li>';
                    }
                    
                    if (auth()->user()->can('customer.view')) {
                        $html .= '<li><a href="/sub/member/show/'.$row->id.'"><i class="fas fa-eye" aria-hidden="true"></i>' . __("messages.view") . '</a></li>';
                    }
                    if (auth()->user()->can('customer.update')) {
                        $html .= '<li><a href="' . action('ContactController@edit', [$row->id]) . '" class="edit_contact_button"><i class="glyphicon glyphicon-edit"></i>' .  __("messages.edit") . '</a></li>';
                    }
                    if (!$row->is_default && auth()->user()->can('customer.delete')) {
                        $html .= '<li><a href="' . action('ContactController@destroy', [$row->id]) . '" class="delete_contact_button"><i class="glyphicon glyphicon-trash"></i>' . __("messages.delete") . '</a></li>';
                    }

                    if (auth()->user()->can('customer.update')) {
                        $html .= '<li><a href="' . action('ContactController@updateStatus', [$row->id]) . '"class="update_contact_status"><i class="fas fa-power-off"></i>';

                        if ($row->contact_status == "active") {
                            $html .= __("messages.deactivate");
                        } else {
                            $html .= __("messages.activate");
                        }

                        $html .= "</a></li>";
                    }

                    $html .= '<li class="divider"></li>';
                    if (auth()->user()->can('customer.view')) {
                        $html .= '
                                <li>
                                    <a href="' . action('ContactController@show', [$row->id]). '?view=ledger">
                                        <i class="fas fa-scroll" aria-hidden="true"></i>
                                        ' . __("lang_v1.ledger") . '
                                    </a>
                                </li>';

                        if (in_array($row->type, ["both", "supplier"])) {
                            $html .= '<li>
                                <a href="' . action('ContactController@show', [$row->id]) . '?view=purchase">
                                    <i class="fas fa-arrow-circle-down" aria-hidden="true"></i>
                                    ' . __("purchase.purchases") . '
                                </a>
                            </li>
                            <li>
                                <a href="' . action('ContactController@show', [$row->id]) . '?view=stock_report">
                                    <i class="fas fa-hourglass-half" aria-hidden="true"></i>
                                    ' . __("report.stock_report") . '
                                </a>
                            </li>';
                        }

                        if (in_array($row->type, ["both", "customer"])) {
                            $html .=  '<li>
                                <a href="' . action('ContactController@show', [$row->id]). '?view=sales">
                                    <i class="fas fa-arrow-circle-up" aria-hidden="true"></i>
                                    ' . __("sale.sells") . '
                                </a>
                            </li>';
                        }

                        $html .= '<li>
                                <a href="' . action('ContactController@show', [$row->id]) . '?view=documents_and_notes">
                                    <i class="fas fa-paperclip" aria-hidden="true"></i>
                                     ' . __("lang_v1.documents_and_notes") . '
                                </a>
                            </li>';
                    }
                    $html .= '</ul></div>';

                    return $html;
                }
            )
            ->editColumn('opening_balance', function ($row) {
                $html = '<span data-orig-value="' . $row->opening_balance . '">' . $this->transactionUtil->num_f($row->opening_balance, true) . '</span>';

                return $html;
            })
            ->editColumn('balance', function ($row) {
                $html = '<span data-orig-value="' . $row->balance . '">' . $this->transactionUtil->num_f($row->balance, true) . '</span>';

                return $html;
            })
            ->editColumn('credit_limit', function ($row) {
                $html = __('lang_v1.no_limit');
                if (!is_null($row->credit_limit)) {
                    $html = '<span data-orig-value="' . $row->credit_limit . '">' . $this->transactionUtil->num_f($row->credit_limit, true) . '</span>';
                }

                return $html;
            })
            ->editColumn('pay_term', '
                @if(!empty($pay_term_type) && !empty($pay_term_number))
                    {{$pay_term_number}}
                    @trans("lang_v1.".$pay_term_type)
                @endif
            ')
            ->editColumn('name', function ($row) {
                $name = $row->name;
                if ($row->contact_status == 'inactive') {
                    $name = $row->name . ' <small class="label pull-right bg-red no-print">' . __("lang_v1.inactive") . '</small>';
                }

                if (!empty($row->converted_by)) {
                    $name .= '<span class="label bg-info label-round no-print" data-toggle="tooltip" title="Converted from leads"><i class="fas fa-sync-alt"></i></span>';
                }
                return $name;
            })
            ->editColumn('total_rp', '{{$total_rp ?? 0}}')
            ->editColumn('created_at', '{{@format_date($created_at)}}')
            ->removeColumn('total_invoice')
            ->removeColumn('opening_balance_paid')
            ->removeColumn('invoice_received')
            ->removeColumn('state')
            ->removeColumn('country')
            ->removeColumn('city')
            ->removeColumn('type')
            ->removeColumn('id')
            ->removeColumn('is_default')
            ->removeColumn('total_sell_return')
            ->removeColumn('sell_return_paid')
            ->filterColumn('address', function ($query, $keyword) {
                $query->where( function($q) use ($keyword){
                    $q->where('address_line_1', 'like', "%{$keyword}%")
                    ->orWhere('address_line_2', 'like', "%{$keyword}%")
                    ->orWhere('city', 'like', "%{$keyword}%")
                    ->orWhere('state', 'like', "%{$keyword}%")
                    ->orWhere('country', 'like', "%{$keyword}%")
                    ->orWhere('zip_code', 'like', "%{$keyword}%")
                    ->orWhereRaw("CONCAT(COALESCE(address_line_1, ''), ', ', COALESCE(address_line_2, ''), ', ', COALESCE(city, ''), ', ', COALESCE(state, ''), ', ', COALESCE(country, '') ) like ?", ["%{$keyword}%"]);
                });
            });
        $reward_enabled = (request()->session()->get('business.enable_rp') == 1) ? true : false;
        if (!$reward_enabled) {
            $contacts->removeColumn('total_rp');
        }
        return $contacts->rawColumns(['action', 'opening_balance', 'credit_limit', 'pay_term', 'due', 'return_due', 'name', 'balance'])
                        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function save(Request $request)
    {
        if ($request->id) {
            $resource = Member::find($request->id);

            $resource->update($request->all());
        } else {
            $resource = Member::create($request->all()); 
        }

        return responseJson(1, __('done'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function show(Request $request, $id)
    {
        $member = Member::find($id);
        return view("subscription::user.profile", compact("member"));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function checkIn(Request $request, $id)
    {
        // set time zone
        $business_id = request()->session()->get('user.business_id');
        $business = Business::where('id', $business_id)->first();
        date_default_timezone_set($business->time_zone);

        $member = $id;
        $resource = Member::find($id);
        $membership = TransactionSellLine::find($request->membership_id);

        if (!$membership) {
            $membership = $resource->subscriptionsQuery()->where('is_stop', '0')->where('is_expire', '0')->first();
        }

        if (!$membership) {
            return responseJson(0, __("no subscription for the member"), [
                "member" => [
                    "id" => $resource->id, 
                    "name" => $resource->name, 
                ],
                "time" => date('H:i:s')
            ]);
        }

        $session = Session::find($membership->session_id); 


        if (!$session) {
            return responseJson(0, __("no session for the member"), [
                "member" => [
                    "id" => $resource->id, 
                    "name" => $resource->name, 
                ],
                "time" => date('H:i:s')
            ]);
        }
         

        //return dd(optional($session)->class_type_id);

        // check subscription
        if (!Subscription::isSubscripe($id, optional($session)->class_type_id)) {
            return responseJson(0, __("no subscription for the member"), [
                "member" => [
                    "id" => $resource->id, 
                    "name" => $resource->name, 
                ],
                "time" => date('H:i:s')
            ]);
        }
        
        $business_id = request()->session()->get('user.business_id');

        $att = DB::table('sub_attandance')
            ->where('session_id', $session->id)
            ->where('member_id', $member)
            ->where('membership_id', $membership->id)
            ->where('date', date('Y-m-d'))
            ->first();

        if ($att) {
            return responseJson(0, __("member already check in session ") . optional($session)->name . " (" . date('Y-m-d') . ")");
        }

        Attandance::create([
            "session_id" => $session->id,
            "member_id" => $member,
            "membership_id" => $membership->id,
            "business_id" => $business_id,
            "date" => date('Y-m-d')
        ]);
 
        // check in expire for subscriptions
        Subscription::checkExpire($id, optional($session)->class_type_id);

        return responseJson(1, __('member has been checked in session ') . optional($session)->name, [
            "member" => [
                "id" => $resource->id, 
                "name" => $resource->name, 
            ],
            "time" => date('H:i:s')
        ]);
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
        $resource  = Member::find($id);
        $resource->delete();

        return responseJson(1, __('member removed'));
    }
}
