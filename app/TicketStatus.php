<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    protected $fillable = ['name','is_send_mail','is_default'];

}
