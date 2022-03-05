<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;

class ClassType extends Model
{
    protected $table = "sub_class_type";

    protected $fillable = [
        'name', 'description', 'image', 'color', 'business_id', 'type'
    ];
    
    protected $appends = [
        'image_url'
    ];

    public function getImageUrlAttribute() {
        return url('/images/sub/class_type.png');
    }


    public static function activeQuery() {
        $business_id = request()->session()->get('user.business_id');
        return self::where('business_id', $business_id);
    }

    public static function active() {
        $business_id = request()->session()->get('user.business_id');
        return self::where('business_id', $business_id)->get();
    }



}
