<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;

class Attandance extends Model
{
    protected $table = "sub_attandance";

    protected $fillable = [
        'session_id', 'business_id', 'member_id', 'date', 'membership_id'
    ];
      
    public static function active() {
        $business_id = request()->session()->get('user.business_id');
        return self::where('business_id', $business_id)->get();
    }

    public function session() {
        return $this->belongsTo(Session::class, "session_id");
    }

    public function member() {
        return $this->belongsTo(Member::class, "member_id");
    }



}
