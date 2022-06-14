<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartmentUser extends Model
{
    protected $fillable = ['user_id','ticket_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function ticket()
    {
        return $this->belongsTo(TicketDepartment::class,'ticket_id','id');
    }
}
