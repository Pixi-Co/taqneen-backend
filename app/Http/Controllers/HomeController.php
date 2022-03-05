<?php

namespace App\Http\Controllers;

use App\BusinessLocation;

use App\Charts\CommonChart;
use App\Currency;
use App\Transaction;
use App\Utils\BusinessUtil;

use App\Utils\ModuleUtil;
use App\Utils\TransactionUtil;
use App\VariationLocationDetails;
use Datatables;
use DB;
use Illuminate\Http\Request;
use App\Utils\Util;
use App\Utils\RestaurantUtil;
use App\Utils\ProductUtil;
use App\User;
use Illuminate\Notifications\DatabaseNotification;
use App\Media;
use App\Product;
use App\PurchaseLine;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\Subscription\Entities\Subscription;

class HomeController extends Controller
{
    /**
     * All Utils instance.
     *
     */
    protected $businessUtil;
    protected $transactionUtil;
    protected $moduleUtil;
    protected $commonUtil;
    protected $restUtil;
    protected $productUtil;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        BusinessUtil $businessUtil,
        TransactionUtil $transactionUtil,
        ModuleUtil $moduleUtil,
        Util $commonUtil,
        ProductUtil $productUtil,
        RestaurantUtil $restUtil
    ) {
        $this->businessUtil = $businessUtil;
        $this->transactionUtil = $transactionUtil;
        $this->moduleUtil = $moduleUtil;
        $this->commonUtil = $commonUtil;
        $this->restUtil = $restUtil;
        $this->productUtil = $productUtil;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexOld()
    {
        $business_id = request()->session()->get('user.business_id');

        if (!auth()->user()->can('dashboard.data')) {
            return view('home.index');
        }

        $fy = $this->businessUtil->getCurrentFinancialYear($business_id);
        $date_filters['this_fy'] = $fy;
        $date_filters['this_month']['start'] = date('Y-m-01');
        $date_filters['this_month']['end'] = date('Y-m-t');
        $date_filters['this_week']['start'] = date('Y-m-d', strtotime('monday this week'));
        $date_filters['this_week']['end'] = date('Y-m-d', strtotime('sunday this week'));

        $currency = Currency::where('id', request()->session()->get('business.currency_id'))->first();

        //Chart for sells last 30 days
        $sells_last_30_days = $this->transactionUtil->getSellsLast30Days($business_id);
        $labels = [];
        $all_sell_values = [];
        $dates = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = \Carbon::now()->subDays($i)->format('Y-m-d');
            $dates[] = $date;

            $labels[] = date('j M Y', strtotime($date));

            if (!empty($sells_last_30_days[$date])) {
                $all_sell_values[] = (float) $sells_last_30_days[$date];
            } else {
                $all_sell_values[] = 0;
            }
        }

        //Get sell for indivisual locations
        $all_locations = BusinessLocation::forDropdown($business_id)->toArray();
        $location_sells = [];
        $sells_by_location = $this->transactionUtil->getSellsLast30Days($business_id, true);
        foreach ($all_locations as $loc_id => $loc_name) {
            $values = [];
            foreach ($dates as $date) {
                $sell = $sells_by_location->first(function ($item) use ($loc_id, $date) {
                    return $item->date == $date &&
                        $item->location_id == $loc_id;
                });

                if (!empty($sell)) {
                    $values[] = (float) $sell->total_sells;
                } else {
                    $values[] = 0;
                }
            }
            $location_sells[$loc_id]['loc_label'] = $loc_name;
            $location_sells[$loc_id]['values'] = $values;
        }

        $sells_chart_1 = new CommonChart;

        $sells_chart_1->labels($labels)
            ->options($this->__chartOptions(__(
                'home.total_sells',
                ['currency' => $currency->code]
            )));

        if (!empty($location_sells)) {
            foreach ($location_sells as $location_sell) {
                $sells_chart_1->dataset($location_sell['loc_label'], 'line', $location_sell['values']);
            }
        }

        if (count($all_locations) > 1) {
            $sells_chart_1->dataset(__('report.all_locations'), 'line', $all_sell_values);
        }

        //Chart for sells this financial year
        $sells_this_fy = $this->transactionUtil->getSellsCurrentFy($business_id, $fy['start'], $fy['end']);

        $labels = [];
        $values = [];

        $months = [];
        $date = strtotime($fy['start']);
        $last   = date('m-Y', strtotime($fy['end']));

        $fy_months = [];
        do {
            $month_year = date('m-Y', $date);
            $fy_months[] = $month_year;

            $month_number = date('m', $date);

            $labels[] = \Carbon::createFromFormat('m-Y', $month_year)
                ->format('M-Y');
            $date = strtotime('+1 month', $date);

            if (!empty($sells_this_fy[$month_year])) {
                $values[] = (float) $sells_this_fy[$month_year];
            } else {
                $values[] = 0;
            }
        } while ($month_year != $last);

        $fy_sells_by_location = $this->transactionUtil->getSellsCurrentFy($business_id, $fy['start'], $fy['end'], true);
        $fy_sells_by_location_data = [];

        foreach ($all_locations as $loc_id => $loc_name) {
            $values_data = [];
            foreach ($fy_months as $month) {
                $sell = $fy_sells_by_location->first(function ($item) use ($loc_id, $month) {
                    return $item->yearmonth == $month &&
                        $item->location_id == $loc_id;
                });

                if (!empty($sell)) {
                    $values_data[] = (float) $sell->total_sells;
                } else {
                    $values_data[] = 0;
                }
            }
            $fy_sells_by_location_data[$loc_id]['loc_label'] = $loc_name;
            $fy_sells_by_location_data[$loc_id]['values'] = $values_data;
        }

        $sells_chart_2 = new CommonChart;
        $sells_chart_2->labels($labels)
            ->options($this->__chartOptions(__(
                'home.total_sells',
                ['currency' => $currency->code]
            )));
        if (!empty($fy_sells_by_location_data)) {
            foreach ($fy_sells_by_location_data as $location_sell) {
                $sells_chart_2->dataset($location_sell['loc_label'], 'line', $location_sell['values']);
            }
        }
        if (count($all_locations) > 1) {
            $sells_chart_2->dataset(__('report.all_locations'), 'line', $values);
        }

        //Get Dashboard widgets from module
        $module_widgets = $this->moduleUtil->getModuleData('dashboard_widget');

        $widgets = [];

        foreach ($module_widgets as $widget_array) {
            if (!empty($widget_array['position'])) {
                $widgets[$widget_array['position']][] = $widget_array['widget'];
            }
        }

        return view('home.index', compact('date_filters', 'sells_chart_1', 'sells_chart_2', 'widgets', 'all_locations'));
    }

    public function index()
    {
        //if (!auth()->user()->can('dashboard.data')) {
        //     return view('home.index');
        //}

        $salesOverview = request()->sales_overview ? request()->sales_overview : 'month';

        $business_id = request()->session()->get('user.business_id');
        $locationIds = request()->location_id > 0 ? [request()->location_id] : BusinessLocation::where('business_id', $business_id)->Active()->pluck('id')->toArray();
        $all_locations = BusinessLocation::forDropdown($business_id)->toArray();
        $location_id = request()->location_id ? request()->location_id :  $locationIds[0];

        $firstDate = optional(DB::table('transactions')->whereIn('location_id', $locationIds)->first())->transaction_date;
        $currentDate = Carbon::now();
        $firstDateOfMonth = Carbon::now()->firstOfMonth();
        $lastDateOfMonth = Carbon::now()->endOfMonth();

        $lastMonthDate = new Carbon('last month');
        $startOfLastMonth = (new Carbon('last month'))->startOfMonth();
        $endDateOfLastMonth = (new Carbon('last month'))->endOfMonth();

        $salesOverviewStartDate = Carbon::now()->startOfWeek();
        $salesOverviewEndDate = Carbon::now()->endOfWeek();

        if ($salesOverview == 'month') {
            $salesOverviewStartDate = Carbon::now()->firstOfMonth();
            $salesOverviewEndDate = Carbon::now()->endOfMonth();
        }

        if ($salesOverview == 'year') {
            $salesOverviewStartDate = Carbon::now()->firstOfYear();
            $salesOverviewEndDate = Carbon::now()->endOfYear();
        }
        /******************* sales *******************/
        // get all order of locations
        $salesLabels = DB::table('transactions')
            ->whereIn('location_id', $locationIds)
            ->where('type', 'sell')
            ->whereBetween('transaction_date', [$salesOverviewStartDate, $salesOverviewEndDate])
            ->pluck('transaction_date')
            ->toArray();

        $salesData = DB::table('transactions')
            ->whereIn('location_id', $locationIds)
            ->where('type', 'sell')
            ->whereBetween('transaction_date', [$salesOverviewStartDate, $salesOverviewEndDate])
            ->pluck('final_total')
            ->toArray();

        $sales2ThisMonthData = DB::table('transactions')
            ->whereIn('location_id', $locationIds)
            ->where('type', 'sell')
            ->whereBetween('transaction_date', [$firstDateOfMonth, $lastDateOfMonth])
            ->pluck('final_total')
            ->toArray();

        $sales2ThisMonthLabels = DB::table('transactions')
            ->whereIn('location_id', $locationIds)
            ->where('type', 'sell')
            ->whereBetween('transaction_date', [$firstDateOfMonth, $lastDateOfMonth])
            ->pluck('transaction_date')
            ->toArray();

        $sales2LastMonthData = DB::table('transactions')
            ->whereIn('location_id', $locationIds)
            ->where('type', 'sell')
            ->whereBetween('transaction_date', [$startOfLastMonth, $endDateOfLastMonth])
            ->pluck('final_total')
            ->toArray();

        $sales2LastMonthLabels = DB::table('transactions')
            ->whereIn('location_id', $locationIds)
            ->where('type', 'sell')
            ->whereBetween('transaction_date', [$startOfLastMonth, $endDateOfLastMonth])
            ->pluck('transaction_date')
            ->toArray();

        $topSellerProductsLabels = DB::table('transaction_sell_lines')
            ->select(
                'product_id',
                DB::raw('sum(quantity) as amount'),
                DB::raw('(select name from products where products.id = product_id) as name')
            )
            ->whereRaw('(select business_id from transactions where transactions.id = transaction_sell_lines.transaction_id) = ?', [$business_id])
            ->distinct('product_id')
            ->groupBy('product_id')
            ->orderBy('amount', 'DESC')
            ->take(3)
            ->pluck('name')
            ->toArray();

        $topSellerProductsData = DB::table('transaction_sell_lines')
            ->select('product_id', DB::raw('sum(quantity) as amount'))
            ->whereRaw('(select business_id from transactions where transactions.id = transaction_sell_lines.transaction_id) = ?', [$business_id])
            ->distinct('product_id')
            ->groupBy('product_id')
            ->orderBy('amount', 'DESC')
            ->take(3)
            ->pluck('amount')
            ->toArray();
        
        $topSellerMemberShipsLabels = DB::table('transaction_sell_lines')
            ->select(
                'product_id',
                DB::raw('sum(quantity) as amount'),
                DB::raw('(select name from products where products.id = product_id) as name')
            )
            ->whereRaw('(select business_id from transactions where transactions.id = transaction_sell_lines.transaction_id) = ?', [$business_id])
            ->whereRaw('(select class_type_id from transactions where transactions.id = transaction_sell_lines.transaction_id) IS NOT NULL') 
            ->distinct('product_id')
            ->groupBy('product_id')
            ->orderBy('amount', 'DESC')
            ->take(3)
            ->pluck('name')
            ->toArray();

        $topSellerMemberShipsData = DB::table('transaction_sell_lines')
            ->select('product_id', DB::raw('sum(quantity) as amount'))
            ->whereRaw('(select business_id from transactions where transactions.id = transaction_sell_lines.transaction_id) = ?', [$business_id])
            ->whereRaw('(select class_type_id from transactions where transactions.id = transaction_sell_lines.transaction_id) IS NOT NULL')  
            ->distinct('product_id')
            ->groupBy('product_id')
            ->orderBy('amount', 'DESC')
            ->take(3)
            ->pluck('amount')
            ->toArray();

        $topSellerCategoryData = DB::table('transaction_sell_lines')
            ->join('products', 'products.id', '=', 'product_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('category_id', DB::raw('sum(quantity) as amount'))
            ->whereRaw('(select business_id from transactions where transactions.id = transaction_sell_lines.transaction_id) = ?', [$business_id])
            ->distinct('category_id')
            ->groupBy('category_id')
            ->orderBy('amount', 'DESC')
            ->take(3)
            ->pluck('amount')
            ->toArray();

        $topSellerCategoryLabels = DB::table('transaction_sell_lines')
            ->join('products', 'products.id', '=', 'product_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('category_id', 'categories.name as category', DB::raw('sum(quantity) as amount'))
            ->whereRaw('(select business_id from transactions where transactions.id = transaction_sell_lines.transaction_id) = ?', [$business_id])
            ->distinct('category_id')
            ->groupBy('category_id')
            ->orderBy('amount', 'DESC')
            ->take(3)
            ->pluck('category')
            ->toArray();


        //return dump($topSellerCategoryLabels);
        /******************* profit *******************/
        $salesOverviewProfitData = $this->transactionUtil->getProfitLossDetails($business_id, $location_id, date('Y-m-d', strtotime($salesOverviewStartDate)), date('Y-m-d', strtotime($salesOverviewEndDate)));

        $profitData = $this->transactionUtil->getProfitLossDetails($business_id, $location_id, date('Y-m-d', strtotime($firstDate)), date('Y-m-d', strtotime($currentDate)));
        $profitDataThisMonth = $this->transactionUtil->getProfitLossDetails($business_id, $location_id, date('Y-m-d', strtotime($firstDateOfMonth)), date('Y-m-d', strtotime($lastDateOfMonth)));
        $profitDataLastMonth = $this->transactionUtil->getProfitLossDetails($business_id, $location_id, date('Y-m-d', strtotime($startOfLastMonth)), date('Y-m-d', strtotime($endDateOfLastMonth)));

        /******************* inventory *****************/
        $inventory = $this->productUtil->getProductStockDetails($business_id, [], "datatables");
        $stock = 0;
        foreach ($inventory->get() as $item)
            $stock += $item->stock;

        /******************* cashier data *****************/
        $cashierSalesQuery = DB::table('transactions')
            ->whereIn('location_id', $locationIds)
            ->where('created_by', Auth::user()->id)
            ->where('type', 'sell');
        

        $cashier = [
            "draft_sales" => $cashierSalesQuery->where('status', 'draft')->sum('final_total'),
            "final_sales" => $cashierSalesQuery->where('status', 'final')->sum('final_total'),
            "pending_sales" => $cashierSalesQuery->where('status', 'pending')->sum('final_total'),
            "received_sales" => $cashierSalesQuery->where('status', 'received')->sum('final_total'),
            "chart_data" => [
                "labels" => $cashierSalesQuery->selectRaw('(select name from contacts where contacts.id = transactions.contact_id limit 1) as contact_name')->groupBy('contact_id')->get()->pluck('contact_name')->toArray(),
                "data" => $cashierSalesQuery->selectRaw('SUM(final_total) as sum_total')->groupBy('contact_id')->get()->pluck('sum_total')->toArray(),
            ]
        ];


        // merge all data 
        $data = [
            "profit" => $profitData,
            "profit_last_month" => $profitDataLastMonth,
            "profit_this_month" => $profitDataThisMonth,
            "profit_salesoverview" => $salesOverviewProfitData,

            "inventory" => $stock,

            "all_locations" => $all_locations,

            "sales_overview" => [
                "data" => $salesData,
                "labels" => $salesLabels
            ],

            "sales_report" => [
                "data1" => $sales2ThisMonthData,
                "labels1" => $sales2ThisMonthLabels,
                "data2" => $sales2LastMonthData,
                "labels2" => $sales2LastMonthLabels,
            ],

            "topseller_product" => [
                "data" => $topSellerProductsData,
                "labels" => $topSellerProductsLabels
            ],

            "topseller_category" => [
                "data" => $topSellerCategoryData,
                "labels" => $topSellerCategoryLabels
            ],

            "topseller_membership" => [
                "data" => $topSellerMemberShipsData,
                "labels" => $topSellerMemberShipsLabels
            ],

            "subscription" => Subscription::getHomePageData(),
            "cashier" => $cashier
        ];

        //return dump($salesData);
        return view('home.index', compact('data', 'salesOverview'));
    }

    /**
     * Retrieves purchase and sell details for a given time period.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTotals()
    {
        if (request()->ajax()) {
            $start = request()->start;
            $end = request()->end;
            $location_id = request()->location_id;
            $business_id = request()->session()->get('user.business_id');

            $purchase_details = $this->transactionUtil->getPurchaseTotals($business_id, $start, $end, $location_id);

            $sell_details = $this->transactionUtil->getSellTotals($business_id, $start, $end, $location_id);

            $transaction_types = [
                'purchase_return', 'sell_return', 'expense'
            ];

            $transaction_totals = $this->transactionUtil->getTransactionTotals(
                $business_id,
                $transaction_types,
                $start,
                $end,
                $location_id
            );

            $total_purchase_inc_tax = !empty($purchase_details['total_purchase_inc_tax']) ? $purchase_details['total_purchase_inc_tax'] : 0;
            $total_purchase_return_inc_tax = $transaction_totals['total_purchase_return_inc_tax'];

            $total_purchase = $total_purchase_inc_tax - $total_purchase_return_inc_tax;
            $output = $purchase_details;
            $output['total_purchase'] = $total_purchase;

            $total_sell_inc_tax = !empty($sell_details['total_sell_inc_tax']) ? $sell_details['total_sell_inc_tax'] : 0;
            $total_sell_return_inc_tax = !empty($transaction_totals['total_sell_return_inc_tax']) ? $transaction_totals['total_sell_return_inc_tax'] : 0;

            $output['total_sell'] = $total_sell_inc_tax - $total_sell_return_inc_tax;

            $output['invoice_due'] = $sell_details['invoice_due'];
            $output['total_expense'] = $transaction_totals['total_expense'];

            return $output;
        }
    }

    public function getProductStockAlertQuery()
    {
        $business_id = request()->session()->get('user.business_id');

        $query = VariationLocationDetails::join(
            'product_variations as pv',
            'variation_location_details.product_variation_id',
            '=',
            'pv.id'
        )
            ->join(
                'variations as v',
                'variation_location_details.variation_id',
                '=',
                'v.id'
            )
            ->join(
                'products as p',
                'variation_location_details.product_id',
                '=',
                'p.id'
            )
            ->leftjoin(
                'business_locations as l',
                'variation_location_details.location_id',
                '=',
                'l.id'
            )
            ->leftjoin('units as u', 'p.unit_id', '=', 'u.id')
            ->where('p.business_id', $business_id)
            ->where('p.enable_stock', 1)
            ->where('p.is_inactive', 0)
            ->whereNull('v.deleted_at')
            ->whereRaw('variation_location_details.qty_available <= p.alert_quantity');

        //Check for permitted locations of a user
        $permitted_locations = auth()->user()->permitted_locations();
        if ($permitted_locations != 'all') {
            $query->whereIn('variation_location_details.location_id', $permitted_locations);
        }

        $products = $query->select(
            'p.name as product',
            'p.type',
            'p.id as product_id',
            'pv.name as product_variation',
            'v.name as variation',
            'l.name as location',
            'variation_location_details.qty_available as stock',
            'u.short_name as unit'
        )
            ->groupBy('variation_location_details.id')
            ->orderBy('stock', 'asc');

        return $products;
    }

    /**
     * Retrieves sell products whose available quntity is less than alert quntity.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductStockAlert()
    {
        if (request()->ajax()) {
            $products = $this->getProductStockAlertQuery();

            return Datatables::of($products)
                ->addColumn('product_image', function ($row) {
                    return '<img src="' . optional(Product::find($row->product_id))->image_url . '" style="width: 60px;height: 60px;border-radius: 5em">';
                })
                ->editColumn('product', function ($row) {
                    if ($row->type == 'single') {
                        return $row->product;
                    } else {
                        return $row->product . ' - ' . $row->product_variation . ' - ' . $row->variation;
                    }
                })
                ->editColumn('stock', function ($row) {
                    $stock = $row->stock ? $row->stock : 0;
                    return '<span data-is_quantity="true" class="display_currency" data-currency_symbol=false>' . (float)$stock . '</span> ' . $row->unit;
                })
                ->removeColumn('unit')
                ->removeColumn('type')
                ->removeColumn('product_variation')
                ->removeColumn('variation')
                ->rawColumns([2, 0, 1])
                ->toJson();
        }
    }

    /**
     * Retrieves payment dues for the purchases.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPurchasePaymentDues()
    {
        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');
            $today = \Carbon::now()->format("Y-m-d H:i:s");

            $query = Transaction::join(
                'contacts as c',
                'transactions.contact_id',
                '=',
                'c.id'
            )
                ->leftJoin(
                    'transaction_payments as tp',
                    'transactions.id',
                    '=',
                    'tp.transaction_id'
                )
                ->where('transactions.business_id', $business_id)
                ->where('transactions.type', 'purchase')
                ->where('transactions.payment_status', '!=', 'paid')
                ->whereRaw("DATEDIFF( DATE_ADD( transaction_date, INTERVAL IF(c.pay_term_type = 'days', c.pay_term_number, 30 * c.pay_term_number) DAY), '$today') <= 7");

            //Check for permitted locations of a user
            $permitted_locations = auth()->user()->permitted_locations();
            if ($permitted_locations != 'all') {
                $query->whereIn('transactions.location_id', $permitted_locations);
            }

            $dues =  $query->select(
                'transactions.id as id',
                'c.name as supplier',
                'c.supplier_business_name',
                'ref_no',
                'final_total',
                DB::raw('SUM(tp.amount) as total_paid')
            )
                ->groupBy('transactions.id');

            return Datatables::of($dues)
                ->addColumn('due', function ($row) {
                    $total_paid = !empty($row->total_paid) ? $row->total_paid : 0;
                    $due = $row->final_total - $total_paid;
                    return '<span class="display_currency" data-currency_symbol="true">' .
                        $due . '</span>';
                })
                ->addColumn('action', '@can("purchase.create") <a href="{{action("TransactionPaymentController@addPayment", [$id])}}" class="btn btn-xs btn-success add_payment_modal"><i class="fas fa-money-bill-alt"></i> @trans("purchase.add_payment")</a> @endcan')
                ->removeColumn('supplier_business_name')
                ->editColumn('supplier', '@if(!empty($supplier_business_name)) {{$supplier_business_name}}, <br> @endif {{$supplier}}')
                ->editColumn('ref_no', function ($row) {
                    if (auth()->user()->can('purchase.view')) {
                        return  '<a href="#" data-href="' . action('PurchaseController@show', [$row->id]) . '"
                                    class="btn-modal" data-container=".view_modal">' . $row->ref_no . '</a>';
                    }
                    return $row->ref_no;
                })
                ->removeColumn('id')
                ->removeColumn('final_total')
                ->removeColumn('total_paid')
                ->rawColumns([0, 1, 2, 3])
                ->make(false);
        }
    }

    /**
     * Retrieves payment dues for the purchases.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSalesPaymentDues()
    {
        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');
            $today = \Carbon::now()->format("Y-m-d H:i:s");

            $query = Transaction::join(
                'contacts as c',
                'transactions.contact_id',
                '=',
                'c.id'
            )
                ->leftJoin(
                    'transaction_payments as tp',
                    'transactions.id',
                    '=',
                    'tp.transaction_id'
                )
                ->where('transactions.business_id', $business_id)
                ->where('transactions.type', 'sell')
                ->where('transactions.payment_status', '!=', 'paid')
                ->whereNotNull('transactions.pay_term_number')
                ->whereNotNull('transactions.pay_term_type')
                ->whereRaw("DATEDIFF( DATE_ADD( transaction_date, INTERVAL IF(transactions.pay_term_type = 'days', transactions.pay_term_number, 30 * transactions.pay_term_number) DAY), '$today') <= 7");

            //Check for permitted locations of a user
            $permitted_locations = auth()->user()->permitted_locations();
            if ($permitted_locations != 'all') {
                $query->whereIn('transactions.location_id', $permitted_locations);
            }

            $dues =  $query->select(
                'transactions.id as id',
                'c.name as customer',
                'c.supplier_business_name',
                'transactions.invoice_no',
                'final_total',
                DB::raw('SUM(tp.amount) as total_paid')
            )
                ->groupBy('transactions.id');

            return Datatables::of($dues)
                ->addColumn('due', function ($row) {
                    $total_paid = !empty($row->total_paid) ? $row->total_paid : 0;
                    $due = $row->final_total - $total_paid;
                    return '<span class="display_currency" data-currency_symbol="true">' .
                        $due . '</span>';
                })
                ->editColumn('invoice_no', function ($row) {
                    if (auth()->user()->can('sell.view')) {
                        return  '<a href="#" data-href="' . action('SellController@show', [$row->id]) . '"
                                    class="btn-modal" data-container=".view_modal">' . $row->invoice_no . '</a>';
                    }
                    return $row->invoice_no;
                })
                ->addColumn('action', '@if(auth()->user()->can("sell.create") || auth()->user()->can("direct_sell.access")) <a href="{{action("TransactionPaymentController@addPayment", [$id])}}" class="btn btn-xs btn-success add_payment_modal"><i class="fas fa-money-bill-alt"></i> @trans("purchase.add_payment")</a> @endif')
                ->editColumn('customer', '@if(!empty($supplier_business_name)) {{$supplier_business_name}}, <br> @endif {{$customer}}')
                ->removeColumn('supplier_business_name')
                ->removeColumn('id')
                ->removeColumn('final_total')
                ->removeColumn('total_paid')
                ->rawColumns([0, 1, 2, 3])
                ->make(false);
        }
    }

    public function getStockExpireQuery(Request $request)
    {
        $business_id = $request->session()->get('user.business_id');

        //TODO:: Need to display reference number and edit expiry date button

        $query = PurchaseLine::leftjoin(
            'transactions as t',
            'purchase_lines.transaction_id',
            '=',
            't.id'
        )
            ->leftjoin(
                'products as p',
                'purchase_lines.product_id',
                '=',
                'p.id'
            )
            ->leftjoin(
                'variations as v',
                'purchase_lines.variation_id',
                '=',
                'v.id'
            )
            ->leftjoin(
                'product_variations as pv',
                'v.product_variation_id',
                '=',
                'pv.id'
            )
            ->leftjoin('business_locations as l', 't.location_id', '=', 'l.id')
            ->leftjoin('units as u', 'p.unit_id', '=', 'u.id')
            ->where('t.business_id', $business_id)
            //->whereNotNull('p.expiry_period')
            //->whereNotNull('p.expiry_period_type')
            //->whereNotNull('exp_date')
            ->where('p.enable_stock', 1);
        // ->whereRaw('purchase_lines.quantity > purchase_lines.quantity_sold + quantity_adjusted + quantity_returned');

        $permitted_locations = auth()->user()->permitted_locations();

        if ($permitted_locations != 'all') {
            $query->whereIn('t.location_id', $permitted_locations);
        }

        if (!empty($request->input('location_id'))) {
            $location_id = $request->input('location_id');
            $query->where('t.location_id', $location_id)
                //If filter by location then hide products not available in that location
                ->join('product_locations as pl', 'pl.product_id', '=', 'p.id')
                ->where(function ($q) use ($location_id) {
                    $q->where('pl.location_id', $location_id);
                });
        }

        if (!empty($request->input('category_id'))) {
            $query->where('p.category_id', $request->input('category_id'));
        }
        if (!empty($request->input('sub_category_id'))) {
            $query->where('p.sub_category_id', $request->input('sub_category_id'));
        }
        if (!empty($request->input('brand_id'))) {
            $query->where('p.brand_id', $request->input('brand_id'));
        }
        if (!empty($request->input('unit_id'))) {
            $query->where('p.unit_id', $request->input('unit_id'));
        }
        if (!empty($request->input('exp_date_filter'))) {
            $query->whereDate('exp_date', '<=', $request->input('exp_date_filter'));
        }

        $only_mfg_products = request()->get('only_mfg_products', 0);
        if (!empty($only_mfg_products)) {
            $query->where('t.type', 'production_purchase');
        }

        $report = $query->select(
            'p.name as product',
            'p.id as product_id',
            'p.sku',
            'p.type as product_type',
            'v.name as variation',
            'p.image as product_image',
            'pv.name as product_variation',
            'l.name as location',
            'mfg_date',
            'exp_date',
            'u.short_name as unit',
            DB::raw("SUM(COALESCE(quantity, 0) - COALESCE(quantity_sold, 0) - COALESCE(quantity_adjusted, 0) - COALESCE(quantity_returned, 0)) as stock_left"),
            't.ref_no',
            't.id as transaction_id',
            'purchase_lines.id as purchase_line_id',
            'purchase_lines.lot_number'
        )
            ->having('stock_left', '>', 0)
            ->groupBy('purchase_lines.exp_date')
            ->groupBy('purchase_lines.lot_number');
        return $report;
    }

    public function loadMoreNotifications(Request $request)
    {
        $notifications = auth()->user()->notifications()->orderBy('created_at', 'DESC')->paginate(10);
        $products = $this->getProductStockAlertQuery()->get();
        $stockAlerts = $this->getStockExpireQuery($request)->get();

        if (request()->input('page') == 1) {
            auth()->user()->unreadNotifications->markAsRead();
        }
        $notifications_data = $this->commonUtil->parseNotifications($notifications);

        return view('layouts.partials.notification_list', compact('notifications_data', 'products', 'stockAlerts'));
    }

    /**
     * Function to count total number of unread notifications
     *
     * @return json
     */
    public function getTotalUnreadNotifications()
    {
        $unread_notifications = auth()->user()->unreadNotifications;
        $total_unread = $unread_notifications->count();

        $notification_html = '';
        $modal_notifications = [];
        foreach ($unread_notifications as $unread_notification) {
            if (isset($data['show_popup'])) {
                $modal_notifications[] = $unread_notification;
                $unread_notification->markAsRead();
            }
        }
        if (!empty($modal_notifications)) {
            $notification_html = view('home.notification_modal')->with(['notifications' => $modal_notifications])->render();
        }

        return [
            'total_unread' => $total_unread,
            'notification_html' => $notification_html
        ];
    }

    private function __chartOptions($title)
    {
        return [
            'yAxis' => [
                'title' => [
                    'text' => $title
                ]
            ],
            'legend' => [
                'align' => 'right',
                'verticalAlign' => 'top',
                'floating' => true,
                'layout' => 'vertical'
            ],
        ];
    }

    public function getCalendar()
    {
        $business_id = request()->session()->get('user.business_id');
        $is_admin = $this->restUtil->is_admin(auth()->user(), $business_id);
        $is_superadmin = auth()->user()->can('superadmin');
        if (request()->ajax()) {
            $data = [
                'start_date' => request()->start,
                'end_date' => request()->end,
                'user_id' => ($is_admin || $is_superadmin) && !empty(request()->user_id) ? request()->user_id : auth()->user()->id,
                'location_id' => !empty(request()->location_id) ? request()->location_id : null,
                'business_id' => $business_id,
                'events' => request()->events ?? [],
                'color' => '#007FFF'
            ];
            $events = [];

            if (in_array('bookings', $data['events'])) {
                $events = $this->restUtil->getBookingsForCalendar($data);
            }

            $module_events = $this->moduleUtil->getModuleData('calendarEvents', $data);

            foreach ($module_events as $module_event) {
                $events = array_merge($events, $module_event);
            }

            return $events;
        }

        $all_locations = BusinessLocation::forDropdown($business_id)->toArray();
        $users = [];
        if ($is_admin) {
            $users = User::forDropdown($business_id, false);
        }

        $event_types = [
            'bookings' => [
                'label' => __('restaurant.bookings'),
                'color' => '#007FFF'
            ]
        ];
        $module_event_types = $this->moduleUtil->getModuleData('eventTypes');
        foreach ($module_event_types as $module_event_type) {
            $event_types = array_merge($event_types, $module_event_type);
        }

        return view('home.calendar')->with(compact('all_locations', 'users', 'event_types'));
    }

    public function showNotification($id)
    {
        $notification = DatabaseNotification::find($id);

        $data = $notification->data;

        $notification->markAsRead();

        return view('home.notification_modal')->with([
            'notifications' => [$notification]
        ]);
    }

    public function attachMediasToGivenModel(Request $request)
    {
        if ($request->ajax()) {
            try {

                $business_id = request()->session()->get('user.business_id');

                $model_id = $request->input('model_id');
                $model = $request->input('model_type');
                $model_media_type = $request->input('model_media_type');

                DB::beginTransaction();

                //find model to which medias are to be attached
                $model_to_be_attached = $model::where('business_id', $business_id)
                    ->findOrFail($model_id);

                Media::uploadMedia($business_id, $model_to_be_attached, $request, 'file', false, $model_media_type);

                DB::commit();

                $output = [
                    'success' => true,
                    'msg' => __('lang_v1.success')
                ];
            } catch (Exception $e) {

                DB::rollBack();

                \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

                $output = [
                    'success' => false,
                    'msg' => __('messages.something_went_wrong')
                ];
            }

            return $output;
        }
    }
}
