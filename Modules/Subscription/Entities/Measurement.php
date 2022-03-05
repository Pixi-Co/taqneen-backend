<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    protected $table = "sub_measurement";

    protected $fillable = [
        'name',	'description',	'business_id'
    ];
     
    public static function active() {
        $business_id = request()->session()->get('user.business_id');
        return self::where('business_id', $business_id)->get();
    }



}
