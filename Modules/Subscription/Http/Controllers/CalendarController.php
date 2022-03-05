<?php

namespace Modules\Subscription\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Subscription\Entities\Trainer;
use Yajra\DataTables\DataTables;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Subscription\Entities\ClassType;
use Modules\Subscription\Entities\FootballOrder;
use Modules\Subscription\Entities\Session;
use Modules\Subscription\Entities\Subscription;

class CalendarController extends Controller
{


    public static $DAYS = [
        "Sat" => 1,
        "Sun" => 2,
        "Mon" => 3,
        "Tue" => 4,
        "Wed" => 5,
        "Thu" => 6,
        "Fri" => 7,
    ];

    public static function getDayName($day)
    {
        $days = [
            1 => "Sat",
            2 => "Sun",
            3 => "Mon",
            4 => "Tue",
            5 => "Wed",
            6 => "Thu",
            7 => "Fri",
        ];

        return isset($days[$day]) ? $days[$day] : '';
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function get()
    {
        $business_id = request()->session()->get('user.business_id');
        $events = [];

        $resources = Subscription::join('transaction_sell_lines', 'transaction_id', '=', 'transactions.id')
            ->select(
                '*',
                'transaction_sell_lines.id as id',
                'transaction_sell_lines.is_expire as is_expire',
                'transaction_sell_lines.class_type_id as class_type_id',
                DB::raw('(select name from contacts where contacts.id = transactions.contact_id) as contact_name'),
                DB::raw('(select name from products where products.id = product_id) as product_name'),
                DB::raw('(transaction_sell_lines.unit_price * transaction_sell_lines.quantity) as final_total')
            )
            ->where('business_id', $business_id)
            ->where('type', 'sell')
            ->where('is_expire', '1')
            ->where('is_subscription', '1')->get();


        if (request()->session_id > 0)
            $resources->where('id', request()->session_id);

        if (request()->trainer_id > 0)
            $resources->where('trainer_id', request()->trainer_id);

        $resources->whereIn('class_type_id', request()->events);



        foreach ($resources as $resource) {
            //dd($resource->getDatesFromSession()); 

            $events[] = [
                'title' => $resource->contact_name . " (" .  $resource->product_name . ")",
                'title_html' => $resource->name,
                'start' => $resource['transaction_date'],
                'end' => $resource['transaction_date'],
                'customer_name' => "customer name",
                'table' => "table",
                'url' => url('/sub'),
                'event_url' => "#",
                'backgroundColor' => "#ef4747",
                'borderColor'     => "#41bc85",
                'allDay'          => false,
                'event_type' => 1
            ];
        }

        return $events;
    }


    public function getEventsOfFootBall()
    {
        $footballClassTypeIds = ClassType::activeQuery()->where('type', 'football')->pluck('id')->toArray();
        $business_id = request()->session()->get('user.business_id');
        $events = [];
        $resources = DB::table('sub_football_order')->select(
            '*',
            DB::raw('(select color from sub_class_type where sub_class_type.id = class_type_id) as color')
        )
            ->where('business_id', $business_id)
            ->whereIn('class_type_id', $footballClassTypeIds)
            ->get();


        foreach ($resources as $resource) {
            $start = $resource->date . " " . $resource->start_time;
            $end = $resource->date . " " . $resource->end_time;
            $events[] = [
                'title' => $resource->name,
                'title_html' => $resource->name,
                'start' => $start,
                'end' => $end,
                'customer_name' => "customer name",
                'table' => "table",
                'url' => url('/sub'),
                'event_url' => "javascript:showFootballOrder(" . $resource->id . ")",
                'backgroundColor' => $resource->color,
                'borderColor'     => "#41bc85",
                'allDay'          => false,
                'event_type' => $resource->class_type_id
            ];
        }

        $date = date('Y-m-d');
        $startHourSetting = session('business.common_settings.football_start_hour');
        $endHourSetting = session('business.common_settings.football_end_hour');

        for ($day = 0; $day <= 7; $day++) {
            $startDateOfWeek = self::getStartAndEndDateOfWeek(Carbon::now()->format('Y-m-d'))[0];
            $date = Carbon::createFromFormat("Y-m-d", $startDateOfWeek)->addDays($day)->format('Y-m-d');

            $startHour = Carbon::createFromFormat('H:i', $startHourSetting);
            $endHour = Carbon::createFromFormat('H:i', $endHourSetting);
            $hours = $startHour->diffInHours($endHour);
            for ($hour = 0; $hour <= $hours; $hour++) {
                $startTime = Carbon::createFromFormat("Y-m-d H:i", $date . " " . $startHourSetting)->addHour($hour)->format("H:i:s");
                $endTime = Carbon::createFromFormat("Y-m-d H:i", $date . " " . $startHourSetting)->addHour($hour + 1)->format("H:i:s");

                $start = Carbon::createFromFormat("Y-m-d H:i", $date . " " . $startHourSetting)->addHour($hour)->format("Y-m-d H:i:s");
                $end = Carbon::createFromFormat("Y-m-d H:i", $date . " " . $startHourSetting)->addHour($hour + 1)->format("Y-m-d H:i:s");

                if (!FootballOrder::isBooked($start, $end, $date))
                    $events[] = [
                        'title' => "free time",
                        'title_html' => "free time",
                        'start' => $start,
                        'end' => $end,
                        'customer_name' => "customer name",
                        'table' => "table",
                        'url' => url('/sub'),
                        'event_url' => "javascript:selectTimeFromCalendar('" . $date . "', '" . Carbon::createFromFormat("H:i", $startHourSetting)->addHour($hour)->format("H:i:s") . "', '" . Carbon::createFromFormat("Y-m-d H:i", $date . " " . $startHourSetting)->addHour($hour + 1)->format("H:i:s") . "')",
                        'backgroundColor' => "#77bb4c",
                        'borderColor'     => "#41bc85",
                        'allDay'          => false,
                        'event_type' => optional(ClassType::activeQuery()->where('type', 'football')->first())->id
                    ];
            }
        }
        return $events;
    }


    /**
     * get day number in week from date
     * 
     * @param type $date
     * @return type
     */
    public static function getDay($date)
    {
        return self::$DAYS[date('D', strtotime($date))];
    }

    /**
     * return start date of week and end date
     * 
     * @param type string of date "Y-m-d"
     * @return type
     */
    public static function getStartAndEndDateOfWeek($date)
    {
        // get current day of week
        $day = self::getDay($date);

        // get different days from week start
        $diffDaysFromWeekStart = $day - 1;

        // get different days from week end
        $diffDaysFromWeekEnd = 7 - $day;

        // calculate start date of week
        $startDateOfWeek = date('Y-m-d', strtotime($date . ' - ' . $diffDaysFromWeekStart . ' days'));

        // calculate start date of week
        $endDateOfWeek = date('Y-m-d', strtotime($date . ' + ' . $diffDaysFromWeekEnd . ' days'));

        return [$startDateOfWeek, $endDateOfWeek];
    }
}
