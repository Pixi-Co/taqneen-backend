<?php

namespace Modules\Subscription\Entities;

use Carbon\Carbon;

class SubHelper  
{  
    public static $days = [
        "sat" => 1,
        "sun" => 2,
        "mon" => 3,
        "tue" => 4,
        "wed" => 5,
        "thu" => 6,
        "fri" => 7
    ];
    
    public static function getDates($type)
    {
        $dates = [];
        
        if ($type == 'week') {
            $dates = [
                Carbon::now()->startOfWeek()->format('Y-m-d'),
                Carbon::now()->endOfWeek()->format('Y-m-d'),
            ];
        } else if ($type == 'month') {
            $dates = [
                Carbon::now()->startOfMonth()->format('Y-m-d'),
                Carbon::now()->endOfMonth()->format('Y-m-d'),
            ];
        } else if ($type == 'year') {
            $dates = [
                Carbon::now()->startOfYear()->format('Y-m-d'),
                Carbon::now()->endOfYear()->format('Y-m-d'),
            ];
        } else {
            $dates = [
                Carbon::now()->format('Y-m-d'),
                Carbon::now()->format('Y-m-d'),
            ];
        }

        return $dates;
    }
}
