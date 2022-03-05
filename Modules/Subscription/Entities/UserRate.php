<?php

namespace Modules\Subscription\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserRate extends Model
{
    protected $table = "sub_user_rates";

    protected $fillable = [
        'ip',	'user_id',	'business_id',	'rate', 'rate_id', 'comment'
    ]; 
 
    public static function active() {
        $business_id = request()->session()->get('user.business_id');
        return self::where('business_id', $business_id)->get();
    }


    public function user() {
        return $this->belongsTo(User::class, "user_id");
    }


    public function rate() {
        return $this->belongsTo(Rate::class, "rate_id");
    }

}
