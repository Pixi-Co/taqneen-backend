<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    protected $fillable = ['name','description','is_send_mail'];

}
