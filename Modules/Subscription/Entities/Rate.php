<?php

namespace Modules\Subscription\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Rate extends Model
{  
    protected $table = "sub_rates";

    protected $fillable = [
        'business_id', 'name', 'description', 'code', 'active'
    ];
    
    protected $appends = [
        'rate_link', 'rate'
    ];

    public function getRateAttribute() {
        return $this->rates()->avg('rate');
    } 

    public function getRateLinkAttribute() {  
        return url("set-rate/")  . "/" . $this->code;
    }
    
    public function rates() {
        return $this->hasMany(UserRate::class, "rate_id");
    } 

    public static function active() {
        $business_id = request()->session()->get('user.business_id');
        return self::where('business_id', $business_id);
    }

    public function getUserRate() {
        return UserRate::where('ip', request()->ip())
        ->where('user_id', optional(Auth::user())->id)
        ->where('rate_id', $this->id)
        ->first();
    }

}
