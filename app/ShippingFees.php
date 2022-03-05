<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingFees extends Model
{
    protected $guarded = [];

    /**
     * Get the user that owns the ShippingFees
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(ShippingCompany::class, 'shipping_company_id');
    }
    /**
     * Get the user that owns the ShippingFees
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo(Area::class, 'shipping_company_id');
    }
}
