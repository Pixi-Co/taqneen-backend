<?php

namespace Modules\Subscription\Entities;

use App\Product;
use App\Transaction;
use App\TransactionSellLine;
use App\Utils\TransactionUtil;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Subscription extends Model
{
    protected $table = "transactions";

    public static $helper = SubHelper::class;
    public static $session = Session::class;
    public static $subscription_status = [
        '1' => 'فى انتنظار استلام الاوراق',
        '2' => 'فى انتظار مراجعة الاوراق',
        '3' => 'تم ارسال الاوراق لعلم',
        '4' => 'فى ارسال الاوراق الاصلية',
        '5' => 'نشط',
        '6' => 'مرفوض', 
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, "contact_id");
    }

    public function classType()
    {
        return $this->belongsTo(ClassType::class, "class_type_id");
    }

    public function session()
    {
        return $this->belongsTo(Session::class, "session_id");
    }

    public static function getHomePageData()
    {
        $salesOverview = request()->sales_overview ? request()->sales_overview : 'month';
        $data = [];

        $data['total_class_type'] = ClassType::activeQuery()->count();
        $data['total_session'] = Session::activeQuery()->count();
        $data['total_trainer'] = Trainer::activeQuery()->count();
        $data['total_member'] = Member::activeQuery()->count();
        $data['total_membership'] = self::memberShips()->count();

        $data['total_subscription'] = self::activeQuery()
            ->whereBetween("transaction_date", self::$helper::getDates($salesOverview))
            ->sum('final_total');

        $data['count_subscription_not_expired'] = self::activeQuery()
            ->whereBetween("transaction_date", self::$helper::getDates($salesOverview))
            ->where('transaction_sell_lines.is_expire', '0')
            ->count();

        $data['count_subscription_expired'] = self::activeQuery()
            ->whereBetween("transaction_date", self::$helper::getDates($salesOverview))
            ->where('transaction_sell_lines.is_expire', '1')
            ->count();

        $data['count_subscription'] = self::activeQuery()
            ->whereBetween("transaction_date", self::$helper::getDates($salesOverview))
            ->count();

        $data['chart_data'] = [
            "labels" => self::chartDataQuery(self::$helper::getDates($salesOverview))->get()->pluck('contact_name')->toArray(),
            "data" => self::chartDataQuery(self::$helper::getDates($salesOverview))->get()->pluck('sum_total')->toArray(),
        ];

        $data['chart_data2'] = [
            "labels" => self::chartDataQuery2(self::$helper::getDates($salesOverview))->get()->pluck('class_type_name')->toArray(),
            "data" => self::chartDataQuery2(self::$helper::getDates($salesOverview))->get()->pluck('sum_total')->toArray(),
        ];

        return $data;
    }

    public static function memberShips()
    {
        $business_id = request()->session()->get('user.business_id');

        return DB::table('products')
            ->whereNotNull('class_type_id')
            ->where('business_id', $business_id);
    }

    public static function chartDataQuery($dates = null)
    {
        $business_id = request()->session()->get('user.business_id');

        return DB::table('transactions')->select(
            'contact_id',
            DB::raw('SUM(final_total) as sum_total'),
        )
            ->selectRaw("(select first_name from contacts where contacts.id = transactions.contact_id limit 1) as contact_name")
            ->where('is_subscription', '1')
            ->where('type', 'sell')
            ->where('business_id', $business_id)
            ->where(function ($q) use ($dates) {
                if ($dates) {
                    $q->whereBetween("transaction_date", [
                        $dates[0] . " 00:00:00",
                        $dates[1] . " 00:00:00"
                    ]);
                }
            })
            ->groupBy("contact_id", "contact_name");
    }


    public static function chartDataQuery2($dates = null)
    {
        $business_id = request()->session()->get('user.business_id');

        return DB::table('transactions')
            ->join('transaction_sell_lines', 'transactions.id', '=', 'transaction_id')
            ->select(
                'transaction_sell_lines.class_type_id as class_type_id',
                DB::raw('SUM(final_total) as sum_total'),
            )
            ->selectRaw("(select name from sub_class_type where sub_class_type.id = transaction_sell_lines.class_type_id limit 1) as class_type_name")
            ->where('is_subscription', '1')
            ->where('type', 'sell')
            ->where('business_id', $business_id)
            ->where(function ($q) use ($dates) {
                if ($dates) {
                    $q->whereBetween("transaction_date", [
                        $dates[0] . " 00:00:00",
                        $dates[1] . " 00:00:00"
                    ]);
                }
            })
            ->groupBy("class_type_id");
    }

    public static function chartData()
    {
        return self::chartDataQuery()->get();
    }

    public static function activeQuery()
    {
        $business_id = request()->session()->get('user.business_id');

        return self::join('transaction_sell_lines', 'transaction_id', '=', 'transactions.id')
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
    }

    public static function active()
    {
        $business_id = request()->session()->get('user.business_id');

        return DB::table('transactions')
            ->whereNotNull('class_type_id')
            ->where('business_id', $business_id)
            ->get();
    }

    public static function loadAvailableSession()
    {
        $business_id = request()->session()->get('user.business_id');
        $subscriptions = DB::table('sub_session')
            ->where('business_id', $business_id)
            ->whereRaw("(select count(member_id) from sub_member_session where session_id = sub_session.id) < group_number")
            ->get();

        return $subscriptions;
    }

    public static function getSubscriptionUnit()
    {
        $business_id = request()->session()->get('user.business_id');
        $name = "اشتراك";
        $unit = DB::table('units')
            ->where('actual_name', 'like', '%' . $name . '%')
            ->where('business_id', $business_id)
            ->first();

        if (!$unit) {
            $unit = DB::table('units')->insert([
                "business_id" => $business_id,
                "actual_name" => $name,
                "short_name" => $name,
                "allow_decimal" => "0",
                "allow_decimal" => "0",
                "created_by" => Auth::user()->id
            ]);

            return self::getSubscriptionUnit();
        }

        return $unit;
    }

    public static function addMemeberToSession($member, $session, $classType)
    {

        if ($classType) {
            $business_id = request()->session()->get('user.business_id');
            $session = DB::table('sub_session')
                ->where('business_id', $business_id)
                ->where('id', $session)
                ->whereRaw("(select count(member_id) from sub_member_session where session_id = sub_session.id) < group_number")
                ->first();
            if (!$session)
                return false;

            DB::table('sub_member_session')->insert([
                "member_id" => $member,
                "session_id" => optional($session)->id,
            ]);

            return true;
        }

        return true;
    }

    public static function isSubscripe($member, $classtype)
    {
        $member = Member::find($member);

        $resource = self::activeQuery()
            ->where('contact_id', $member->id)
            ->where('transaction_sell_lines.class_type_id', $classtype)
            ->where('transaction_sell_lines.is_expire', '0')
            ->latest('transaction_sell_lines.created_at')
            ->first();

        return $resource ? true : false;
    }

    public static function checkExpire($member, $classtype)
    {
        $member = Member::find($member);

        $resources = self::activeQuery()
            ->where('contact_id', $member->id)
            ->where('class_type_id', $classtype)
            ->where('is_expire', '0')
            ->latest('transaction_sell_lines.created_at')
            ->get();
 
        foreach ($resources as $row) {
            $resource = TransactionSellLine::find($row->id);
            $memberShip = Product::find($row->product_id);

            if ($resource->is_stop == '1') {
                $start = Carbon::createFromFormat('Y-m-d', $resource->stop_start_date);
                $end = Carbon::createFromFormat('Y-m-d', $resource->stop_end_date);

                if (!Carbon::now()->between($start, $end)) {
                    $resource->is_stop = '0';
                    $resource->update();
                }
            }

            if ($memberShip && $resource->is_stop == '0') {

                $count = DB::table('sub_attandance')
                    ->where('member_id', $member->id)
                    ->where('session_id', $resource->session_id)
                    ->where('membership_id', $row->id)
                    ->count(); 

                // check subscription number;
                if ($memberShip->subscription_number > 0) {
                    if ($count >= $memberShip->subscription_number) {
                        $resource->update([
                            'is_expire' => '1'
                        ]);
                    }
                }

                // check days number;
                if ($memberShip->days > 0) {
                    $subDate = Carbon::parse(strtotime($resource->transaction_date));
                    $days = Carbon::now()->diffInDays($subDate);

                    if ($days >= $memberShip->days) {
                        $resource->update([
                            'is_expire' => '1'
                        ]);
                    }
                }
            }

            return true;
        } 

        return true;
    }

    public static function renewSubscription($transaction_sellline_id) {
        $resource = TransactionSellLine::find($transaction_sellline_id)->toArray(); 
        $transaction_id = $resource['transaction_id'];

        $data = Transaction::find($transaction_id)->toArray();
        Transaction::where('id', $transaction_id)->update([
            "is_renew" => '1'
        ]);
 

        $data['transaction_date'] = Carbon::now();
        unset($data['id']); 
        //$util = new TransactionUtil();
        $newTrans = Transaction::create($data); 
        $resource['is_expire'] = 0;
        $resource['transaction_id'] = $newTrans->id;
        $newResource = TransactionSellLine::create($resource);

        return true;
    }

    public static function getSources() {
        return session('business.common_settings.subscription_sources')? json_decode(session('business.common_settings.subscription_sources')) : [];
    }
}
