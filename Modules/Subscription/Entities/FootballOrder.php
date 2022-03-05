<?php

namespace Modules\Subscription\Entities;

use App\Contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FootballOrder extends Model
{
    protected $table = "sub_football_order";

    protected $fillable = [
        'name',    'description',    'group_number',    'date',
        'start_time',    'end_time',    'contact_id',    'business_id',    'class_type_id'
    ];

    protected $appends = [];



    public function contact()
    {
        return $this->belongsTo(Contact::class, "contact_id");
    }

    public function classType()
    {
        return $this->belongsTo(ClassType::class, "class_type_id");
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



    public static function isBooked($start, $end, $date)
    {
        $footballClassTypeIds = ClassType::activeQuery()->where('type', 'football')->pluck('id')->toArray();
        $business_id = request()->session()->get('user.business_id'); 
        $resource = DB::table('sub_football_order')->select(
            '*',
            DB::raw('(select color from sub_class_type where sub_class_type.id = class_type_id) as color')
        )
            ->where('business_id', $business_id)
            ->where('date', $date)
            ->whereIn('class_type_id', $footballClassTypeIds)
            ->where('start_time', "<=", $start)
            ->where('end_time', ">=", $end)
            ->first();
        return $resource ? true : false;
    }

    public static function ifBooked($start, $end, $date)
    {
        $footballClassTypeIds = ClassType::activeQuery()->where('type', 'football')->pluck('id')->toArray();
        $business_id = request()->session()->get('user.business_id'); 
        $resource = DB::table('sub_football_order')->select(
            '*',
            DB::raw('(select color from sub_class_type where sub_class_type.id = class_type_id) as color')
        )
            ->where('business_id', $business_id)
            ->where('date', $date)
            ->whereIn('class_type_id', $footballClassTypeIds)
            ->where(function ($q) use ($start, $end) {
                $q->where('start_time', "<", $end)
                ->where('end_time', ">=", $end);
            })
            ->first();
        return $resource ? true : false;
    }
}
