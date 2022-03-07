<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServicePackage extends Model
{ 
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = "taqneen_package";
    

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
 

    public function service() {
        return $this->belongsTo(Category::class, "service_id");
    } 
}
