<?php

namespace Modules\Subscription\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Trainer extends User
{  
    protected $table = "users";

    protected $fillable = [
        'first_name', 'last_name', 'username', 'email', 'password', 'class_type_ids', 
        'address', 'is_trainer', 'status', 'salary', 'profit_percent'
    ];
    
    protected $appends = [
        'image_url', 'full_name', 'rate_link', 'qrcode_link', 'rate', 'class_type_names'
    ];

    public function getClassTypeNamesAttribute() {
        return implode(", ", $this->classType()->pluck('name')->toArray());
    }

    public function getRateAttribute() {
        return $this->rates()->avg('rate');
    }

    public function getQrcodeLinkAttribute() {
        return url('/trainer/check-in/') . "/" . $this->id;
    }

    public function getRateLinkAttribute() {
        if (!$this->remember_token) {
            $this->remember_token = randToken();
            $this->update();
        }

        return url("rate-trainer/") . "/" . $this->remember_token;
    }

    public function getFullNameAttribute() {
        return implode(",", [$this->first_name, $this->last_name]);
    }

    public function getImageUrlAttribute() {
        return url('/images/sub/class_type.png');
    }

    public function members() { 
        $arr = $this->sessions()->pluck('id')->toArray();
        if (count($arr) <= 0)
            $arr = [0];

        $memberIds = DB::table('sub_member_session')->whereIn('session_id', $arr)->pluck('member_id')->toArray();
        return Member::select(
            '*',
            DB::raw('(select name from sub_session where id in ('.implode(",", $arr).') limit 1) as session_name'),
            DB::raw('(select id from sub_session where id in ('.implode(",", $arr).') limit 1) as session_id'),
            )->whereIn('id', $memberIds);
    }

    public function classType() {
        $ids = [];
        if ($this->class_type_ids)
            $ids = json_decode($this->class_type_ids, true);

        return ClassType::whereIn('id', $ids); 
    }

    public function sessions() {
        return $this->hasMany(Session::class, "trainer_id");
    }

    public function attandances() {
        return $this->hasMany(Session::class, "trainer_id");
    }

    public function rates() {
        return $this->hasMany(TrainerRate::class, "trainer_id");
    }

    public function scopeUser($query)
    {
        return $query->where('users.user_type', 'trainer');
    }

    public static function activeQuery() {
        $business_id = request()->session()->get('user.business_id');
        return self::where('business_id', $business_id)->where("user_type", 'trainer')->where('status', 'active');
    }

    public static function active() {
        $business_id = request()->session()->get('user.business_id');
        return self::where('business_id', $business_id)->where("user_type", 'trainer')->where('status', 'active')->get();
    }

}
