<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Member extends Model
{
    protected $table = "contacts";
 
    
    
    protected $appends = [
        'image_url', 'qrcode_link'
    ];

    public function getQrcodeLinkAttribute() {
        return url('/sub/member/check-in/') . "/" . $this->id;
    }
 
    public function getImageUrlAttribute() {
        return url('/images/avatar.png');
    }

    public function getChartDataOfMeasurement($measurement) {
        $query = DB::table('sub_member_measurement')
            ->where('member_id', $this->id)
            ->where('measurement_id', $measurement)
            ->select('date')
            ->selectRaw('SUM(result) as data')
            ->groupBy('date');

        return [
            "labels" => $query->pluck('date')->toArray(),
            "data" => $query->pluck('data')->toArray(),
        ]; 
    }

    public function measurements() {
        return $this->hasMany(MemberMeasurement::class, "member_id");
    }

    public function sessionsQuery() {
        return Session::whereIn('id', DB::table('sub_member_session')->where('member_id', $this->id)->pluck('session_id')->toArray());
    }

    public function sessions() {
        return Session::whereIn('id', DB::table('sub_member_session')->where('member_id', $this->id)->pluck('session_id')->toArray())->get();
    }
 
    public static function activeQuery() {
        $business_id = request()->session()->get('user.business_id');
        return self::where('business_id', $business_id);
    }
 
    public static function active() {
        $business_id = request()->session()->get('user.business_id');
        return self::where('business_id', $business_id)->get();
    }

    public function subscriptionsQuery() {
        $business_id = request()->session()->get('user.business_id');
        
        return Subscription::activeQuery()
            ->where('contact_id', $this->id);
    }

    public function subscriptions() {
        $business_id = request()->session()->get('user.business_id');
        
        return Subscription::activeQuery()
            ->where('contact_id', $this->id) 
            ->get();
    }

    public function attandances() {
        $business_id = request()->session()->get('user.business_id');
        
        return Attandance::where('business_id', $business_id)
            ->where('member_id', $this->id)
            ->get();
    }
}
