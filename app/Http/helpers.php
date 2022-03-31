<?php

use App\TransKey;
use Spatie\Permission\Models\Permission;

if (!function_exists('uploadImg')) {
    function uploadImg($file, $folder = '/', $action, $oldPath = null)
    {

        $filename = "";
        if ($file) {
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $dest = public_path('/' . $folder);
            $file->move($dest, $filename);

            if ($oldPath) {
                if (file_exists(public_path($oldPath))) {
                    unlink(public_path($oldPath));
                }
            }
            $action($filename);
        }

        return $filename;
    }
}

/**
 * boots pos.
 */
if (!function_exists('pos_boot')) {
    function pos_boot($ul, $pt, $lc, $em, $un, $type = 1, $pid = null)
    {
        $ch = curl_init();
        $request_url = ($type == 1) ? base64_decode(config('author.lic1')) : base64_decode(config('author.lic2'));

        $pid = is_null($pid) ? config('author.pid') : $pid;

        $curlConfig = [
            CURLOPT_URL => $request_url,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS     => [
                'url' => $ul,
                'path' => $pt,
                'license_code' => $lc,
                'email' => $em,
                'username' => $un,
                'product_id' => $pid
            ]
        ];
        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = 'C' . 'U' . 'RL ' . 'E' . 'rro' . 'r: ';
            $error_msg .= curl_errno($ch);

            return redirect()->back()
                ->with('error', $error_msg);
        }
        curl_close($ch);

        if ($result) {
            $result = json_decode($result, true);

            if ($result['flag'] == 'valid') {
                // if(!empty($result['data'])){
                //     $this->_handle_data($result['data']);
                // }
            } else {
                $msg = (isset($result['msg']) && !empty($result['msg'])) ? $result['msg'] : "I" . "nvali" . "d " . "Lic" . "ense Det" . "ails";
                return redirect()->back()
                    ->with('error', $msg);
            }
        }
    }
}

if (!function_exists('humanFilesize')) {
    function humanFilesize($size, $precision = 2)
    {
        $units = ['B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        $step = 1024;
        $i = 0;

        while (($size / $step) > 0.9) {
            $size = $size / $step;
            $i++;
        }

        return round($size, $precision) . $units[$i];
    }
}

if (!function_exists('randToken')) {

    /**
     * random token every milisecond encrypted
     * @return type String
     */
    function randToken()
    {
        // time in mili seconds
        $timeInMiliSeconds = (int) round(microtime(true) * 1000);

        // random number with 8 digit
        $randKey1 = rand(11111111, 99999999);

        // token
        $token = $timeInMiliSeconds + $randKey1;

        // convert token to array
        $tokenToArray = str_split($token);

        // shif array
        array_shift($tokenToArray);

        // array to string
        $token = implode("", $tokenToArray);

        // encrypt token
        $cryptedToken = encrypt($token);

        // return token in small size
        $b = json_decode(base64_decode($cryptedToken));

        // return mac attribute
        return $b->mac;
    }
}
/**
 * Checks if the uploaded document is an image
 */
if (!function_exists('isFileImage')) {
    function isFileImage($filename)
    {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $array = ['png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG', 'gif', 'GIF'];
        $output = in_array($ext, $array) ? true : false;

        return $output;
    }
}

if (!function_exists('isAppInstalled')) {
    function isAppInstalled()
    {
        $envPath = base_path('.env');
        return file_exists($envPath);
    }
}

/**
 * Checks if pusher has credential or not
 *
 * and return boolean
 */
if (!function_exists('isPusherEnabled')) {
    function isPusherEnabled()
    {
        $is_pusher_enabled = false;

        if (!empty(config('broadcasting.connections.pusher.key')) && !empty(config('broadcasting.connections.pusher.secret')) && !empty(config('broadcasting.connections.pusher.app_id')) && !empty(config('broadcasting.connections.pusher.options.cluster')) && (config('broadcasting.connections.pusher.driver') == 'pusher')) {
            $is_pusher_enabled = true;
        }

        return $is_pusher_enabled;
    }
}

/**
 * Checks if user agent is mobile or not
 *
 * @return boolean
 */
if (!function_exists('isMobile')) {
    function isMobile()
    {
        $useragent = $_SERVER['HTTP_USER_AGENT'];

        if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('str_ordinal')) {
    /**
     * Append an ordinal indicator to a numeric value.
     *
     * @param  string|int  $value
     * @param  bool  $superscript
     * @return string
     */
    function str_ordinal($value, $superscript = false)
    {
        $number = abs($value);

        $indicators = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];

        $suffix = $superscript ? '<sup>' . $indicators[$number % 10] . '</sup>' : $indicators[$number % 10];
        if ($number % 100 >= 11 && $number % 100 <= 13) {
            $suffix = $superscript ? '<sup>th</sup>' : 'th';
        }

        return number_format($number) . $suffix;
    }
}
 
if (!function_exists('can_bt')) {
    /**
     * Returns the active subscription details for a business
     *
     * @param  int $business_id
     * @param  string $perm_name
     *
     * @return bool
     */
    function can_bt($perms, $operator = "and", $business_type_id = null)
    {
        if (auth()->user()->can('superadmin')) {
            return true;
        }


        $resource = optional(auth()->user()->business->subscriptions()->latest()->first())->package;

        if (!$resource) {
            return false;
        }

        $valid = true;
        foreach ($perms as $perm) {
            if ($operator == 'and') {
                $valid = $valid && $resource->canAccess($perm);
            } else {
                $valid = $valid || $resource->canAccess($perm);
            }
        }

        return $valid;
    }
}

if (!function_exists('canAccessModule')) {
    /**
     * Returns the active subscription details for a business
     *
     * @param  int $business_id
     * @param  string $perm_name
     *
     * @return bool
     */
    function canAccessModule($perm_name, $business_id = null)
    {
        return true;

        $business_id = $business_id ?? auth()->user()->business_id;

        if ($business_id == 1) {
            return true;
        }

        // $packageDetails = \Illuminate\Support\Facades\Cache::remember('subscription_details_' . $business_id, 3600, function () use ($business_id) {
        $date_today = Carbon\Carbon::today()->toDateString();

        $subscriptionDetails = \Modules\Superadmin\Entities\Subscription::with('modules')
            ->where('business_id', $business_id)
            ->whereDate('start_date', '<=', $date_today)
            ->whereDate('end_date', '>=', $date_today)
            ->approved()
            ->get();

        // dd($subscriptionDetails);
        // dd($subscriptionDetails->pluck('modules')->flatten()->unique('id')->implode('slug', ','));
        // return $subscriptionDetails->pluck('modules')->flatten()->unique('id')->implode('slug', ',');
        $subscriptionDetails = $subscriptionDetails->pluck('modules')->flatten()->unique('id')->implode('slug', ',');
        // });

        $modules = explode(',', $subscriptionDetails);

        if (is_array($perm_name)) {
            $result = array_intersect($perm_name, $modules);
            return !empty($result);
        }

        if (str_contains($perm_name, '*')) {
            $replaced = Str::replaceLast('*', '', $perm_name);
            return strpos($subscriptionDetails, $replaced) !== false;
        }
        return in_array($perm_name, $modules);
    }
}

if (!function_exists('responseJson')) {
    function responseJson($status, $message, $data = null)
    {
        return [
            "status" => $status,
            "message" => $message,
            "data" => $data,
        ];
    }
}

if (!function_exists('isRtl')) {
    function isRtl()
    {
        $lang = "ar";

        if (session('user.language'))
            $lang = session()->get('user.language');
        return in_array($lang, config('constants.langs_rtl'));
    }
}

if (!function_exists('getPages')) {
    function getPages()
    {
        $pages = [];

        if (auth()->user()->can('product.view')) {
            $pages['products?type=product'] = __('sale.products');
        }

        if (auth()->user()->can('stock_report.view')) {
            $pages['products?type=stock'] = __('report.stock_report');
        }

        if (auth()->user()->can('supplier.view')) {
            $pages['contacts?type=supplier'] = __('lang_v1.suppliers');
        }

        if (auth()->user()->can('customer.view')) {
            $pages['contacts?type=customer'] = __('lang_v1.customers');
        }

        if (auth()->user()->can('user.view')) {
            $pages['settings?type=users'] = __('user.users');
        }

        if (auth()->user()->can('sell.view')) {
            $pages['sells'] = __('lang_v1.all_sales');
        }

        if (auth()->user()->can('purchase.view')) {
            $pages['purchases'] = __('purchase.purchases');
        }

        if (auth()->user()->can('access_sell_return')) {
            $pages['sell-return'] = __('lang_v1.sell_return');
        }

        if (can_bt(['shipping']))
            if (auth()->user()->can('access_shipping')) {
                $pages['shipments'] = __('lang_v1.shipments');
            }

        if (auth()->user()->can('access_sell_return')) {
            $pages['purchase-return'] = __('lang_v1.purchase_return');
        }

        return $pages;
    }
}

if (!function_exists('randColor')) {
    function randColor()
    {
        $colors = [
            "w3-red",
            "w3-pink",
            "w3-green",
            "w3-blue",
            "w3-purple",
            "w3-deep-purple",
            "w3-indigo",
            "w3-light-blue",
            "w3-cyan",
            "w3-aqua",
            "w3-teal",
            "w3-lime",
            "w3-light-green",
            "w3-orange",
            "w3-blue-gray",
            "w3-brown",
        ];

        return $colors[array_rand($colors)];
    }
}

if (!function_exists('randTextColor')) {
    function randTextColor()
    {
        $colors = [
            "w3-text-red",
            "w3-text-pink",
            "w3-text-green",
            "w3-text-blue",
            "w3-text-purple",
            "w3-text-deep-purple",
            "w3-text-indigo",
            "w3-text-light-blue",
            "w3-text-cyan",
            "w3-text-aqua",
            "w3-text-teal",
            "w3-text-lime",
            "w3-text-light-green",
            "w3-text-orange",
            "w3-text-blue-gray",
            "w3-text-brown",
        ];

        return $colors[array_rand($colors)];
    }
}

if (!function_exists('getBusinessDescriptions')) {
    function getBusinessDescriptions()
    {
        return [
            "1" => [
                "name" => "Business owner",
                "icon" => "fas fa-user",
            ],
            "2" => [
                "name" => "Inventory or operations",
                "icon" => "fas fa-warehouse",
            ],
            "3" => [
                "name" => "Production or manufacturing",
                "icon" => "fas fa-tools",
            ],
            "4" => [
                "name" => "Purchasing or procurement",
                "icon" => "fas fa-truck-moving",
            ],
            "5" => [
                "name" => "Finance or office administration",
                "icon" => "fas fa-money-bill-wave",
            ],
            "6" => [
                "name" => "Sales or marketing",
                "icon" => "fas fa-shopping-basket",
            ],
            "7" => [
                "name" => "Consultant",
                "icon" => "fas fa-users",
            ],
        ];
    }
}


if (!function_exists('sendMailJet')) {
    /**
     * send email api
     *
     * @param String $to       destination email
     * @param String $message  the message of the email
     * @param String $subject  the subject of the email
     * @param String $from     the emai will send the message
     * @return boolean         true if sent, false if not
     */
    function sendMailJet($to, $subject, $message, $name = "vauxerp", $sub_subject = null, $header_img = "/images/img-25.jpg", $footer = "", $from = "info@vauxerp.com", $link = "", $view = 'emails.template2')
    {
        $mj = new \Mailjet\Client(env('MJ_APIKEY_PUBLIC'), env('MJ_APIKEY_PRIVATE'), true, ['version' => 'v3.1']);
        // Define your request body
        $message = view($view, compact('message', 'subject', 'sub_subject', 'name', 'footer', 'header_img', 'link'));
        $message = str_replace("\n", "\r", $message);
        $subject = str_replace("\n", "\r", $subject);

        $from = "alifaragmahmed@gmail.com";

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "$from",
                        'Name' => $name
                    ],
                    'To' => [
                        [
                            'Email' => "$to",
                            'Name' => "You"
                        ]
                    ],
                    'Subject' => $subject,
                    'TextPart' => "",
                    'HTMLPart' => $message
                ]
            ]
        ];

        // All resources are located in the Resources class
        $response = $mj->post(Mailjet\Resources::$Email, ['body' => $body]);

        return $response;
        // Read the response
        //$response->success() && var_dump($response->getData());
    }
}

if (!function_exists('sendMail')) {
    /**
     * send email api
     *
     * @param String $to       destination email
     * @param String $message  the message of the email
     * @param String $subject  the subject of the email
     * @param String $from     the emai will send the message
     * @return boolean         true if sent, false if not
     */
    function sendMail($to, $subject, $message, $name = "vauxerp", $sub_subject = null, $header_img = "/images/img-25.jpg", $footer = "", $from = "info@vauxerp.com")
    {
        $response = null;
        try {
            $message = view('emails.template1', compact('message', 'subject', 'sub_subject', 'name', 'footer', 'header_img'));
            $message = str_replace("\n", "\r", $message);
            $subject = str_replace("\n", "\r", $subject);

            ini_set("SMTP", "aspmx.l.google.com");
            ini_set("sendmail_from", $from);


            $headers = array(
                'From' => $from,
                'To' => $to,
                'Subject' => $subject,
                'MIME-Version' => '1.0',
                'Content-Type' => "text/html; charset=ISO-8859-1"
            );


            $response = mail($to, $subject, $message, $headers);
            //dump($response);
        } catch (Exception $exc) {
        }

        return $response;
    }
}

// function canAccessModule($perm_name){
//    $active_sub = auth()->user()->business->getCurrentActiveSubs();
//    $can_access = 0;
//    if($active_sub){
//        $package_id = $active_sub->package_id;
//        $package = \Modules\Superadmin\Entities\Package::find($package_id);
//        if($package){
//            if(isset($package->custom_permissions[$perm_name]) && $package->custom_permissions[$perm_name]){
//                $can_access = 1;
//            }
//        }
//    }
//    return $can_access;
// }


if (!function_exists('format_currency')) {
    function format_currency($number)
    {
        $formated_number = "";
        if (session("business.currency_symbol_placement") == "before") {
            $formated_number .= session("currency")["symbol"] . " ";
        }
        $formated_number .= number_format((float) $number, config("constants.currency_precision", 2), session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

        if (session("business.currency_symbol_placement") == "after") {
            $formated_number .= " " . session("currency")["symbol"];
        }
        return $formated_number;
    }
}

if (!function_exists('find_or_create_p')) {
    function find_or_create_p($name)
    {
        $p = Permission::where('name', $name)->first();

        if (!$p) {
            $p = Permission::create([
                "name" => $name
            ]);
        }

        return $name;
    }
}

if (!function_exists('__')) {

    /**
     * Translate the given message.
     *
     * @param  string|null  $key
     * @param  array   $replace
     * @param  string|null  $locale
     * @return \Illuminate\Contracts\Translation\Translator|string|array|null
     */
    function __($key = null, $replace = [], $locale = null)
    {
        $key = str_replace(" ", "_", $key);
        $key = strtolower($key);
        try {
            if (is_null($key)) {
                return app('translator');
            }

            // default lang
            $userLang = "ar";

            // default business
            $business = 1;

            if (auth()->user()) {
                $userLang = auth()->user()->language;
                $business = auth()->user()->business->typeId;
            } else {
                $userLang = request()->language ? request()->language : 'ar';
            }

            //$trans1 = app('translator')->trans($key, $replace, $locale);
            $trans = app('translator')->trans($key, $replace, "en");

            // store key in database first
            TransKey::insertKey($key, $trans);

            $language = session('languages_keys_trans')[$userLang] ?? 1;

            return $language ?
                App\Translation::trans($key, $language, $business) :
                $trans;
        } catch (Exception $th) {
            dd($th);
            return $key;
        }
    }
}

if (!function_exists('trans')) {
    /**
     * Translate the given message.
     *
     * @param  string|null  $key
     * @param  array   $replace
     * @param  string|null  $locale
     * @return \Illuminate\Contracts\Translation\Translator|string|array|null
     */
    function trans($key = null, $replace = [], $locale = null)
    {
        $key = strtolower($key);
        return __($key, $replace, $locale);
    }
}

if (!function_exists('trans_lang')) {
    /**
     * Translate the given message.
     *
     * @param  string|null  $key
     * @param  array   $replace
     * @param  string|null  $locale
     * @return \Illuminate\Contracts\Translation\Translator|string|array|null
     */
    function trans_lang($key = null, $replace = [], $locale = null)
    {
        $key = strtolower($key);
        try {
            if (is_null($key)) {
                return app('translator');
            }

            return  app('translator')->trans($key, $replace, $locale);
        } catch (\Exception $th) {
            return $key;
        }
    }
}
