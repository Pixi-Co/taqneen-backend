<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionLine extends Model
{
    
    protected $table = "subscription_lines";
    
    protected $appends = ['service', 'package'];

    public function getServiceAttribute()
    {
        return optional($this->service()->first())->name;
    }

    public function getPackageAttribute()
    {
        return optional($this->package()->first())->name;
    }

    public function getPriceAttribute()
    {
        return $this->total;
    }

    public function service() {
        return $this->belongsTo(Category::class, "service_id");
    }

    public function package() {
        return $this->belongsTo(ServicePackage::class, "package_id");
    }
}
