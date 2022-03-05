<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $guarded = [];

    public static function forDropdown()
    {
        $dropdown = Area::pluck('name', 'id');

        return $dropdown;
    }
}
