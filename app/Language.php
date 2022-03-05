<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 

class Language extends Model
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = "language";


    protected $fillable = [
        'name',    'short_name',    'key',    'flag',    'is_rtl',    'active'
    ];
}
