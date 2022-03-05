<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShippingCompany extends Model
{
    protected $guarded = [];

    /**
     * Get the user that owns the ShippingFees
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fees()
    {
        return $this->hasMany(ShippingFees::class);
    }

    /**
     * Get all of the sells for the ShippingCompany
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sells(): HasMany
    {
        return $this->hasMany(Transaction::class, 'shipping_company_id');
    }

    /**
     * Returns list of invoice schemes in array format
     */
    public static function forDropdown($business_id)
    {
        $dropdown = ShippingCompany::where('business_id', $business_id)
                                ->pluck('name', 'id');

        return $dropdown;
    }
}
