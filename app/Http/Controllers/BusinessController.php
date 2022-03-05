<?php

namespace App\Http\Controllers;

use App\Account;
use App\Business;
use App\Currency;
use App\ExpenseCategory;
use App\Notifications\TestEmailNotification;
use App\System;
use App\TaxRate;
use App\Unit;
use App\User;
use App\Utils\BusinessUtil;
use App\Utils\ModuleUtil;
use App\Utils\RestaurantUtil;
use Carbon\Carbon;
use DateTimeZone;
use Dotenv\Validator;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Modules\Superadmin\Http\Controllers\BaseController;
use Spatie\Permission\Models\Permission;

class BusinessController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | BusinessController
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new business/business as well as their
    | validation and creation.
    |
    */

    /**
     * All Utils instance.
     *
     */
    protected $businessUtil;
    protected $restaurantUtil;
    protected $moduleUtil;
    protected $mailDrivers;

    /**
     * Constructor
     *
     * @param BusinessUtil $businessUtil
     * @param RestaurantUtil $restaurantUtil
     * @param ModuleUtil $moduleUtil
     */
    public function __construct(BusinessUtil $businessUtil, RestaurantUtil $restaurantUtil, ModuleUtil $moduleUtil)
    {
        $this->businessUtil = $businessUtil;
        $this->moduleUtil = $moduleUtil;

        $this->theme_colors = [
            'blue' => 'Blue',
            'black' => 'Black',
            'purple' => 'Purple',
            'green' => 'Green',
            'red' => 'Red',
            'yellow' => 'Yellow',
            'blue-light' => 'Blue Light',
            'black-light' => 'Black Light',
            'purple-light' => 'Purple Light',
            'green-light' => 'Green Light',
            'red-light' => 'Red Light',
        ];

        $this->mailDrivers = [
            'smtp' => 'SMTP',
            // 'sendmail' => 'Sendmail',
            // 'mailgun' => 'Mailgun',
            // 'mandrill' => 'Mandrill',
            // 'ses' => 'SES',
            // 'sparkpost' => 'Sparkpost'
        ];
    }

    public function verfiy()
    {
        return view("auth.verfiy");
    }

    public function signwithGoogle(Request $request)
    { 
        $validator = validator()->make( [ 
            'id' => 'required'
        ],[] );

        $user = User::where('google', $request->id)->first();

        if ($user) {
            Auth::login($user);
            $output = ['success' => 1, 'msg' => __('done')];  

            return $output; 
        } else { 
            $output = ['success' => 0, 'msg' => __('cant sign with google')]; 
            return $output; 
        }
    }

    public function postVerfiy(Request $request)
    { 
        $validator = validator()->make(
            [
                'email' => 'required|email|max:255',
            ],
            [
                'email.email' => __('validation.email', ['attribute' => __('business.email')]),
            ]
        );

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if ($user->status != 'inactive') { 
                $output = ['success' => 1, 'msg' => __('email already verified')];  
                return $output;
            }


            $user->requireActivation();
            $output = ['success' => 1, 'msg' => __('verfication email has been sent')];  

            return $output;
            //return redirect('login')->with('status', $output);
        } else { 
            $output = ['success' => 0, 'msg' => __('email not exists')];   

            return $output; 
        }
    }
 
    /**
     * Shows registration form
     *
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function settings()
    {
        if (!config('constants.allow_registration')) {
            return redirect('/');
        }

        $currencies = $this->businessUtil->allCurrencies();

        $timezone_list = $this->businessUtil->allTimeZones();

        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = __('business.months.' . $i);
        }

        $accounting_methods = $this->businessUtil->allAccountingMethods();
        $package_id = request()->package;

        $system_settings = System::getProperties(['superadmin_enable_register_tc', 'superadmin_register_tc'], true);

        return view('settings.index', compact(
            'currencies',
            'timezone_list',
            'months',
            'accounting_methods',
            'package_id',
            'system_settings'
        ));
    }

    /**
     * Shows registration form
     *
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function settingsTab()
    {
        if (!auth()->user()->can('business_settings.access')) {
            abort(403, 'Unauthorized action.');
        }

        $timezones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
        $timezone_list = [];
        foreach ($timezones as $timezone) {
            $timezone_list[$timezone] = $timezone;
        }

        $business_id = request()->session()->get('user.business_id');
        $business = Business::where('id', $business_id)->first();

        $currencies = $this->businessUtil->allCurrencies();
        $tax_details = TaxRate::forBusinessDropdown($business_id);
        $tax_rates = $tax_details['tax_rates'];

        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = __('business.months.' . $i);
        }

        $accounting_methods = [
            'fifo' => __('business.fifo'),
            'lifo' => __('business.lifo')
        ];
        $commission_agent_dropdown = [
            '' => __('lang_v1.disable'),
            'logged_in_user' => __('lang_v1.logged_in_user'),
            'user' => __('lang_v1.select_from_users_list'),
            'cmsn_agnt' => __('lang_v1.select_from_commisssion_agents_list')
        ];

        $units_dropdown = Unit::forDropdown($business_id, true);

        $date_formats = Business::date_formats();

        $shortcuts = json_decode($business->keyboard_shortcuts, true);

        $pos_settings = empty($business->pos_settings) ? $this->businessUtil->defaultPosSettings() : json_decode($business->pos_settings, true);

        $email_settings = empty($business->email_settings) ? $this->businessUtil->defaultEmailSettings() : $business->email_settings;

        $sms_settings = empty($business->sms_settings) ? $this->businessUtil->defaultSmsSettings() : $business->sms_settings;

        $modules = $this->moduleUtil->availableModules();

        $theme_colors = $this->theme_colors;

        $mail_drivers = $this->mailDrivers;

        $allow_superadmin_email_settings = System::getProperty('allow_email_settings_to_businesses');

        $custom_labels = !empty($business->custom_labels) ? json_decode($business->custom_labels, true) : [];

        $common_settings = !empty($business->common_settings) ? $business->common_settings : [];

        $weighing_scale_setting = !empty($business->weighing_scale_setting) ? $business->weighing_scale_setting : [];

        $sales_commission_agent = User::select(
            'id',
            'first_name'
        )->where('business_id', $business_id)
        ->where('is_cmmsn_agnt', 1)
        ->pluck('first_name', 'id')
        ->toArray();

        $viewName = 'business.settings';

        if (request()->setting_type == 'settings_custom_labels') {
            $viewName = 'business.custom_field';
        }

        if (request()->setting_type == 'settings_purchase') {
            $viewName = 'business.purchase_setting';
        }

        if (request()->setting_type == 'settings_product') {
            $viewName = 'business.product_setting';
        }

        if (request()->setting_type == 'settings_weighing') {
            $viewName = 'business.weighing_setting';
        }

        return view("business.custom_setting", compact('sales_commission_agent', 'business', 'currencies', 'tax_rates', 'timezone_list', 'months', 'accounting_methods', 'commission_agent_dropdown', 'units_dropdown', 'date_formats', 'shortcuts', 'pos_settings', 'modules', 'theme_colors', 'email_settings', 'sms_settings', 'mail_drivers', 'allow_superadmin_email_settings', 'custom_labels', 'common_settings', 'weighing_scale_setting'));
    
    }

    /**
     * Shows registration form
     *
     * @return Response
     */
    public function emailVerfiy()
    {
        return view("auth.verify_account");
    }

    /**
     * Shows registration form
     *
     * @return Response
     */
    public function getRegister()
    {
        if (!config('constants.allow_registration')) {
            return redirect('/');
        }

        $currencies = $this->businessUtil->allCurrencies();

        $timezone_list = $this->businessUtil->allTimeZones();

        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = __('business.months.' . $i);
        }

        $accounting_methods = $this->businessUtil->allAccountingMethods();
        $package_id = request()->package;

        $system_settings = System::getProperties(['superadmin_enable_register_tc', 'superadmin_register_tc'], true);

        return view('business.register', compact(
            'currencies',
            'timezone_list',
            'months',
            'accounting_methods',
            'package_id',
            'system_settings'
        ));
    }


    /**
     * Handles the registration of a new business and it's owner
     *
     * @return Response
     */
    public function postRegister(Request $request)
    {
        if (!config('constants.allow_registration')) {
            return redirect('/');
        }
 

        try {
            //return dump($request->all());
            $validator = validator()->make(
                [
                    'name' => 'required|max:255',
                    'first_name' => 'required|max:255',
                    'last_name' => 'required|max:255',
                    'currency_id' => 'required|numeric',
                    'businesstype_id' => 'required|numeric',
                    'bussiness_description' => 'required',
                    'email' => 'required|email|unique:users|max:255',
                    'first_name' => 'required|max:255',
                    'username' => 'required|min:4|max:255|unique:users',
                    'password' => 'required|min:4|max:255',
                ],
                [
                    'name.required' => __('validation.required', ['attribute' => __('business.business_name')]),
                    'name.currency_id' => __('validation.required', ['attribute' => __('business.currency')]),
                    'email.email' => __('validation.email', ['attribute' => __('business.email')]),
                    'email.email' => __('validation.unique', ['attribute' => __('business.email')]),
                    'first_name.required' => __('validation.required', ['attribute' => __('business.first_name')]),
                    'username.required' => __('validation.required', ['attribute' => __('business.username')]),
                    'username.min' => __('validation.min', ['attribute' => __('business.username')]),
                    'password.required' => __('validation.required', ['attribute' => __('business.username')]),
                    'password.min' => __('validation.min', ['attribute' => __('business.username')]),
                ]
            );

            DB::beginTransaction();

            //Create owner.
            $owner_details = $request->only([
                'surname',
                'first_name',
                'last_name',
                'username',
                'email',
                'password',
                'language',
                'businesstype_id',
                'bussiness_description',
            ]);

            $owner_details['language'] = empty($owner_details['language']) ? config('app.locale') : $owner_details['language'];

            $user = User::create_user($owner_details);

            $business_details = $request->only(['name', 'start_date', 'currency_id', 'time_zone']);
            $business_details['fy_start_month'] = 1;

            $business_location = $request->only(['name', 'country', 'state', 'city', 'zip_code', 'landmark', 'website', 'mobile', 'alternate_number']);

            //Create the business
            $business_details['owner_id'] = $user->id;
            if (!empty($business_details['start_date'])) {
                $business_details['start_date'] = Carbon::createFromFormat(config('constants.default_date_format'), $business_details['start_date'])->toDateString();
            }

            //upload logo
            $logo_name = $this->businessUtil->uploadFile($request, 'business_logo', 'business_logos', 'image');
            if (!empty($logo_name)) {
                $business_details['logo'] = $logo_name;
            }

            //default enabled modules
            $business_details['enabled_modules'] = ['purchases', 'add_sale', 'pos_sale', 'stock_transfers', 'stock_adjustment', 'expenses'];

            $business = $this->businessUtil->createNewBusiness($business_details);

            //Update user with business id
            $user->business_id = $business->id;
            $user->save();

            $this->businessUtil->newBusinessDefaultResources($business->id, $user->id);
            $new_location = $this->businessUtil->addLocation($business->id, $business_location);

            //create new permission with the new location
            Permission::create(['name' => 'location.' . $new_location->id]);

            DB::commit();

            //Module function to be called after after business is created
            if (config('app.env') != 'demo') {
                $this->moduleUtil->getModuleData('after_business_created', ['business' => $business]);
            }

            // create subscription 
            $subscription_details = $request->only(['package_id', 'paid_via', 'payment_transaction_id']);
            $subscription_details['paid_via'] = "offline";
            $subscription_details['payment_transaction_id'] = null;
            //Add subscription if present

            //dump($subscription_details);
            //return 1;
            if (!empty($subscription_details['package_id']) && !empty($subscription_details['paid_via'])) {
                $con = new BaseController;
                $subscription =  $con->_add_subscription($user->business_id, $subscription_details['package_id'], $subscription_details['paid_via'], $subscription_details['payment_transaction_id'],$user->id, true);
            }

            //Process payment information if superadmin is installed & package information is present
            /*$is_installed_superadmin = $this->moduleUtil->isSuperadminInstalled();
            $package_id = $request->get('package_id', null);
            if ($is_installed_superadmin && !empty($package_id) && (config('app.env') != 'demo')) {
                $package = \Modules\Superadmin\Entities\Package::find($package_id);
                if (!empty($package)) {
                    Auth::login($user);
                    return redirect()->route('register-pay', ['package_id' => $package_id]);
                }
            }*/

            // required activation
            if (strlen($request->google_id) <= 0)
                $user->requireActivation();

            $output = [
                'success' => 1,
                'msg' => __('business_created_succesfully_please_verify_your_email')
            ];
            // load chart of account
            Account::loadChartAccounts($business->id);

            // load expenses
            ExpenseCategory::loadExpensesTypes($business->id);

            
            if (strlen($request->google_id) > 0) {
                $output = [
                    'success' => 1,
                    'msg' => __('business created successfully')
                ];
                Auth::login($user);
                return redirect('home')->with('status', $output);
            } else {
                return redirect('email-verify?email=' . $user->email)->with('status', $output);
            }
        } catch (Exception $e) {
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = ['success' => 0, 'msg' => __('messages.something_went_wrong')];

            //return dump($e->getMessage());

            return back()->with('status', $output)->withInput();
        }
    }

    /**
     * Handles the validation username
     *
     * @return Response
     */
    public function postCheckUsername(Request $request)
    {
        $username = $request->input('username');

        if (!empty($request->input('username_ext'))) {
            $username .= $request->input('username_ext');
        }

        $count = User::where('username', $username)->count();

        if ($count == 0) {
            echo "true";
            exit;
        } else {
            echo "false";
            exit;
        }
    }


    /**
     * Shows business settings form
     *
     * @return Application|Factory|View
     */
    public function getBusinessSettings()
    {
        if (!auth()->user()->can('business_settings.access')) {
            abort(403, 'Unauthorized action.');
        }

        $timezones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
        $timezone_list = [];
        foreach ($timezones as $timezone) {
            $timezone_list[$timezone] = $timezone;
        }

        $business_id = request()->session()->get('user.business_id');
        $business = Business::where('id', $business_id)->first();

        $currencies = $this->businessUtil->allCurrencies();
        $tax_details = TaxRate::forBusinessDropdown($business_id);
        $tax_rates = $tax_details['tax_rates'];

        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = __('business.months.' . $i);
        }

        $accounting_methods = [
            'fifo' => __('business.fifo'),
            'lifo' => __('business.lifo')
        ];
        $commission_agent_dropdown = [
            '' => __('lang_v1.disable'),
            'logged_in_user' => __('lang_v1.logged_in_user'),
            'user' => __('lang_v1.select_from_users_list'),
            'cmsn_agnt' => __('lang_v1.select_from_commisssion_agents_list')
        ];

        $units_dropdown = Unit::forDropdown($business_id, true);

        $date_formats = Business::date_formats();

        $shortcuts = json_decode($business->keyboard_shortcuts, true);

        $pos_settings = empty($business->pos_settings) ? $this->businessUtil->defaultPosSettings() : json_decode($business->pos_settings, true);

        $email_settings = empty($business->email_settings) ? $this->businessUtil->defaultEmailSettings() : $business->email_settings;

        $sms_settings = empty($business->sms_settings) ? $this->businessUtil->defaultSmsSettings() : $business->sms_settings;

        $modules = $this->moduleUtil->availableModules();

        $theme_colors = $this->theme_colors;

        $mail_drivers = $this->mailDrivers;

        $allow_superadmin_email_settings = System::getProperty('allow_email_settings_to_businesses');

        $custom_labels = !empty($business->custom_labels) ? json_decode($business->custom_labels, true) : [];

        $common_settings = !empty($business->common_settings) ? $business->common_settings : [];

        $weighing_scale_setting = !empty($business->weighing_scale_setting) ? $business->weighing_scale_setting : [];

        $viewName = 'business.settings';

        if (request()->setting_type == 'settings_custom_labels') {
            $viewName = 'business.custom_field';
        }

        if (request()->setting_type == 'settings_purchase') {
            $viewName = 'business.purchase_setting';
        }

        if (request()->setting_type == 'settings_product') {
            $viewName = 'business.product_setting';
        }

        if (request()->setting_type == 'settings_weighing') {
            $viewName = 'business.weighing_setting';
        }

        return view($viewName, compact('business', 'currencies', 'tax_rates', 'timezone_list', 'months', 'accounting_methods', 'commission_agent_dropdown', 'units_dropdown', 'date_formats', 'shortcuts', 'pos_settings', 'modules', 'theme_colors', 'email_settings', 'sms_settings', 'mail_drivers', 'allow_superadmin_email_settings', 'custom_labels', 'common_settings', 'weighing_scale_setting'));
    }

    /**
     * Updates business settings
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function postBusinessSettings(Request $request)
    {
        if (!auth()->user()->can('business_settings.access')) {
            abort(403, 'Unauthorized action.');
        }

        $output = [
            'success' => 1,
            'msg' => __('business.settings_updated_success')
        ];
        try {
            $notAllowed = $this->businessUtil->notAllowedInDemo();
            if (!empty($notAllowed)) {
                return $notAllowed;
            }

            $business_details = $request->only([
                'name', 'start_date', 'currency_id', 'tax_label_1', 'tax_number_1', 'tax_label_2', 'tax_number_2', 'default_profit_percent', 'default_sales_tax', 'default_sales_discount', 'sell_price_tax', 'sku_prefix', 'time_zone', 'fy_start_month', 'accounting_method', 'transaction_edit_days', 'sales_cmsn_agnt', 'item_addition_method', 'currency_symbol_placement', 'on_product_expiry',
                'stop_selling_before', 'default_unit', 'expiry_type', 'date_format',
                'time_format', 'ref_no_prefixes', 'theme_color', 'email_settings',
                'sms_settings', 'rp_name', 'amount_for_unit_rp',
                'min_order_total_for_rp', 'max_rp_per_order', 'tax_number', 'commercial_number',
                'redeem_amount_per_unit_rp', 'min_order_total_for_redeem',
                'min_redeem_point', 'max_redeem_point', 'rp_expiry_period',
                'rp_expiry_type', 'custom_labels', 'weighing_scale_setting', 
                'select_sales_commission_id', 'common_settings'
            ]);

            if (!empty($request->input('enable_rp')) &&  $request->input('enable_rp') == 1) {
                $business_details['enable_rp'] = 1;
            } else {
                $business_details['enable_rp'] = 0;
            }

            $business_details['amount_for_unit_rp'] = !empty($business_details['amount_for_unit_rp']) ? $this->businessUtil->num_uf($business_details['amount_for_unit_rp']) : 1;
            $business_details['min_order_total_for_rp'] = !empty($business_details['min_order_total_for_rp']) ? $this->businessUtil->num_uf($business_details['min_order_total_for_rp']) : 1;
            $business_details['redeem_amount_per_unit_rp'] = !empty($business_details['redeem_amount_per_unit_rp']) ? $this->businessUtil->num_uf($business_details['redeem_amount_per_unit_rp']) : 1;
            $business_details['min_order_total_for_redeem'] = !empty($business_details['min_order_total_for_redeem']) ? $this->businessUtil->num_uf($business_details['min_order_total_for_redeem']) : 1;

            $business_details['default_profit_percent'] = !empty($business_details['default_profit_percent']) ? $this->businessUtil->num_uf($business_details['default_profit_percent']) : 0;

            $business_details['default_sales_discount'] = !empty($business_details['default_sales_discount']) ? $this->businessUtil->num_uf($business_details['default_sales_discount']) : 0;

            if (!empty($business_details['start_date'])) {
                $business_details['start_date'] = $this->businessUtil->uf_date($business_details['start_date']);
            }

            if (!empty($request->input('enable_tooltip')) &&  $request->input('enable_tooltip') == 1) {
                $business_details['enable_tooltip'] = 1;
            } else {
                $business_details['enable_tooltip'] = 0;
            }

            $business_details['enable_product_expiry'] = !empty($request->input('enable_product_expiry')) &&  $request->input('enable_product_expiry') == 1 ? 1 : 0;

            if (isset($business_details['on_product_expiry'])) {
                if ($business_details['on_product_expiry'] == 'keep_selling') {
                    $business_details['stop_selling_before'] = null;
                }
            }

            $business_details['stock_expiry_alert_days'] = !empty($request->input('stock_expiry_alert_days')) ? $request->input('stock_expiry_alert_days') : 30;

            //Check for Purchase currency
            if (!empty($request->input('purchase_in_diff_currency')) &&  $request->input('purchase_in_diff_currency') == 1) {
                $business_details['purchase_in_diff_currency'] = 1;
                $business_details['purchase_currency_id'] = $request->input('purchase_currency_id');
                $business_details['p_exchange_rate'] = $request->input('p_exchange_rate');
            } else {
                $business_details['purchase_in_diff_currency'] = 0;
                $business_details['purchase_currency_id'] = null;
                $business_details['p_exchange_rate'] = 1;
            }

            //upload logo
            $logo_name = $this->businessUtil->uploadFile($request, 'business_logo', 'business_logos', 'image');
            if (!empty($logo_name)) {
                $business_details['logo'] = $logo_name;
            }

            $checkboxes = [
                'enable_editing_product_from_purchase',
                'enable_inline_tax',
                'enable_brand', 'enable_category', 'enable_sub_category', 'enable_price_tax', 'enable_purchase_status',
                'enable_lot_number', 'enable_racks', 'enable_row', 'enable_position', 'enable_sub_units'
            ];
            foreach ($checkboxes as $value) {
                $business_details[$value] = !empty($request->input($value)) &&  $request->input($value) == 1 ? 1 : 0;
            }

            $business_id = request()->session()->get('user.business_id');
            $business = Business::where('id', $business_id)->first();

            //Update business settings
            if (!empty($business_details['logo'])) {
                $business->logo = $business_details['logo'];
            } else {
                unset($business_details['logo']);
            }

            //System settings
            if ($request->input('shortcuts')) {
                $shortcuts = $request->input('shortcuts');
                $business_details['keyboard_shortcuts'] = json_encode($shortcuts);
            }

            //pos_settings 
            if ($request->input('pos_settings')) {

                $pos_settings = $request->input('pos_settings');
                $default_pos_settings = $this->businessUtil->defaultPosSettings();
                foreach ($default_pos_settings as $key => $value) {
                    if (!isset($pos_settings[$key])) {
                        $pos_settings[$key] = $value;
                    }
                }
                $business_details['pos_settings'] = json_encode($pos_settings);
            }

            // common_settings
            if (isset($business_details['common_settings'])) {
                $business_details['common_settings'] = !empty($request->input('common_settings')) ? $request->input('common_settings') : [];
            }

            // custom_labels
            if (isset($business_details['custom_labels'])) {
                $business_details['custom_labels'] = json_encode($business_details['custom_labels']);
            }

            //Enabled modules  
            if ($request->input('enabled_modules')) {
                $enabled_modules = $request->input('enabled_modules');
                $business_details['enabled_modules'] = !empty($enabled_modules) ? $enabled_modules : null;
            }

            //unset($business_details['custom_labels']); 
            $business->fill($business_details);
            $business->save();

            //update session data
            $request->session()->put('business', $business);

            //Update Currency details
            $currency = Currency::find($business->currency_id);
            $request->session()->put('currency', [
                'id' => $currency->id,
                'code' => $currency->code,
                'symbol' => $currency->symbol,
                'thousand_separator' => $currency->thousand_separator,
                'decimal_separator' => $currency->decimal_separator,
            ]);

            //update current financial year to session
            $financial_year = $this->businessUtil->getCurrentFinancialYear($business->id);
            $request->session()->put('financial_year', $financial_year);

            $output = [
                'success' => 1,
                'msg' => __('business.settings_updated_success')
            ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = [
                'success' => 0,
                'msg' => $e->getMessage() //__('messages.something_went_wrong')
            ];
        }

        return responseJson($output['success'], $output['msg']);
        return redirect('business/settings')->with('status', $output);
    }

    /**
     * Handles the validation email
     *
     * @return Response
     */
    public function postCheckEmail(Request $request)
    {
        $email = $request->input('email');

        $query = User::where('email', $email);

        if (!empty($request->input('user_id'))) {
            $user_id = $request->input('user_id');
            $query->where('id', '!=', $user_id);
        }

        $exists = $query->exists();
        if (!$exists) {
            echo "true";
            exit;
        } else {
            echo "false";
            exit;
        }
    }

    public function getEcomSettings()
    {
        try {
            $api_token = request()->header('API-TOKEN');
            $api_settings = $this->moduleUtil->getApiSettings($api_token);

            $settings = Business::where('id', $api_settings->business_id)
                ->value('ecom_settings');

            $settings_array = !empty($settings) ? json_decode($settings, true) : [];

            if (!empty($settings_array['slides'])) {
                foreach ($settings_array['slides'] as $key => $value) {
                    $settings_array['slides'][$key]['image_url'] = !empty($value['image']) ? url('uploads/img/' . $value['image']) : '';
                }
            }
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            return $this->respondWentWrong($e);
        }

        return $this->respond($settings_array);
    }

    /**
     * Handles the testing of email configuration
     *
     * @return Response
     */
    public function testEmailConfiguration(Request $request)
    {
        try {
            $email_settings = $request->input();

            $data['email_settings'] = $email_settings;
            \Notification::route('mail', $email_settings['mail_from_address'])
                ->notify(new TestEmailNotification($data));

            $output = [
                'success' => 1,
                'msg' => __('lang_v1.email_tested_successfully')
            ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            $output = [
                'success' => 0,
                'msg' => $e->getMessage()
            ];
        }

        return $output;
    }

    /**
     * Handles the testing of sms configuration
     *
     * @return Response
     */
    public function testSmsConfiguration(Request $request)
    {
        try {
            $sms_settings = $request->input();

            $data = [
                'sms_settings' => $sms_settings,
                'mobile_number' => $sms_settings['test_number'],
                'sms_body' => 'This is a test SMS',
            ];
            if (!empty($sms_settings['test_number'])) {
                $response = $this->businessUtil->sendSms($data);
            } else {
                $response = __('lang_v1.test_number_is_required');
            }

            $output = [
                'success' => 1,
                'msg' => $response
            ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            $output = [
                'success' => 0,
                'msg' => $e->getMessage()
            ];
        }

        return $output;
    }
}
