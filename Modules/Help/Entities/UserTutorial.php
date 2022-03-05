<?php

namespace Modules\Help\Entities;

use Illuminate\Database\Eloquent\Model;

class UserTutorial extends Model
{

    protected $table = "help_user_tutorial";

    protected $fillable = [
        'user_id',    'tutorial_id',    'is_done'
    ];
 
 
}
