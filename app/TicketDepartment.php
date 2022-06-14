<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketDepartment extends Model
{
    protected $guarded = ['id'];

    public function parentDepartment(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
       return $this->hasMany(TicketDepartment::class,'parent_id','id');
    }

    public function departmentChildes(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TicketDepartment::class,'parent_id','id');
    }

}
