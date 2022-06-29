<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['status_id','department_id','user_id','agent_id','description','completed_at','priority_id','created_by','computer_num','client_email','client_name','client_phone'];

    public function status()
    {
        return $this->belongsTo(TicketStatus::class,'status_id','id');
    }

    public function department()
    {
//        another relation refere to parent department inside TicketDepartment
        return $this->belongsTo(TicketDepartment::class,'department_id','id')->with('department');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function agent()
    {
        return $this->belongsTo(User::class,'agent_id','id')->with('contactInfo');
    }

    public function priority()
    {
        return $this->belongsTo(TicketPriority::class,'priority_id','id');
    }

    public function getTagValue($tag) {
        $resource = $this;
        return $resource->$tag;
    }
}
