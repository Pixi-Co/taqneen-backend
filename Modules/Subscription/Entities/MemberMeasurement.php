<?php

namespace Modules\Subscription\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DB;

class MemberMeasurement extends Model
{
    protected $table = "sub_member_measurement";

    protected $fillable = [
        'member_id',	'measurement_id',	'result',	'date'
    ];
   
    public function meassurement() {
        return $this->belongsTo(Measurement::class, "measurement_id");
    }

    public function member() {
        return $this->belongsTo(Member::class, "member_id");
    } 
 
    public static function active() {
        $business_id = request()->session()->get('user.business_id');
        return self::where('business_id', $business_id)->get();
    }

    public static function getChartData() {
        $query = DB::table('sub_member_measurement')  
            ->select('date')
            ->selectRaw('SUM(result) as data')
            ->groupBy('date');

        return [
            "labels" => $query->pluck('date')->toArray(),
            "data" => $query->pluck('data')->toArray(),
        ]; 
    }
 
}
