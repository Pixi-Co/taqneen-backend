<?php

namespace Modules\Subscription\Entities;

use App\CustomerGroup;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DB;

class Session extends Model
{
    protected $table = "sub_session";

    protected $fillable = [
        'name',    'description',    'group_number',
        'date_from',    'date_to',
        'sat_from',    'sat_to',
        'sun_from',    'sun_to',    
        'mon_from',    'mon_to',
        'tue_from',    'tue_to',    
        'wed_from',    'wed_to',
        'thu_from',    'thu_to',    
        'fri_from',    'fri_to',
        'repeat',    'class_type_id',    'trainer_id',    
        'business_id',    'customer_group_id'
    ];

    public static $days = [
        "sat" => 1,
        "sun" => 2,
        "mon" => 3,
        "tue" => 4,
        "wed" => 5,
        "thu" => 6,
        "fri" => 7
    ];

    public function customerGroup()
    {
        return $this->belongsTo(CustomerGroup::class, "customer_group_id");
    }

    public function classType()
    {
        return $this->belongsTo(ClassType::class, "class_type_id");
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class, "trainer_id");
    }

    public function members()
    {
        return Member::whereIn('id', DB::table('sub_member_session')->where('session_id', $this->id)->pluck('member_id')->toArray())->get();
    }

    public static function activeQuery()
    {
        $business_id = request()->session()->get('user.business_id');
        return self::where('business_id', $business_id);
    }

    public static function active()
    {
        $business_id = request()->session()->get('user.business_id');
        return self::where('business_id', $business_id)->get();
    }


    public function getDatesFromSession()
    {
        $startDateOfWeek = Carbon::now()->startOfWeek();
        $dates = [];
        //addDays

        foreach (self::$days as $key => $value) {
            $from = $key . "_from";
            $to = $key . "_to";
            $date = $startDateOfWeek->addDays($value)->format('Y-m-d');

            if ($this->$from && $this->$to) {
                $dates[] = [
                    "from" => $date . " " . $this->$from,
                    "to" => $date . " " . $this->$to,
                ];
            } 
        }

        return $dates;
    }
}
