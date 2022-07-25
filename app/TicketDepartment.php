<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketDepartment extends Model
{
    protected $guarded = ['id'];

    public function subDepartments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
       return $this->hasMany(TicketDepartment::class,'parent_id','id')->with('priority');
    }

    public function department(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TicketDepartment::class,'parent_id','id');
    }

    public function priority()
    {
        return $this->belongsTo(TicketPriority::class,'priority_id','id');
    }

    public function subDepartmentsWithPriorty()
    {
        return $this->subDepartments()->with('priority');
    }

    public function departmentUser()
    {
        return $this->hasMany(DepartmentUser::class,'department_id')->has('user');
    }

}
