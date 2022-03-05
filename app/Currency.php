<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    
    public static function active() {
        return self::where('active', '1');
    }
}
