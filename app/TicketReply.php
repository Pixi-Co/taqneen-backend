<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    protected $fillable =['user_id','file','reply','ticket_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id')->select(['id','first_name','last_name','email']);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class,'ticket_id');
    }

    protected $casts =[
        'file'=>'array'
    ];
}
