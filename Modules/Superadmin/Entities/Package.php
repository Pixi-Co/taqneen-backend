<?php

namespace Modules\Superadmin\Entities;

use App\BusinessType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Package extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'custom_permissions' => 'array',
    ];

    public $appends = ['image_url'];

    public function getImageUrlAttribute() {
        $this->interval == 'days'? $this->interval = 'month' : '';
        return $this->image ? url($this->image) : url('images/' . $this->interval . "-package.png");
    }
    
    /**
     * Scope a query to only include active packages.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    /**
     * Returns the list of active pakages
     *
     * @return object
     */
    public static function listPackages($exlude_private = false)
    {
        $packages = Package::active()
                        ->orderby('sort_order');

        if ($exlude_private) {
            $packages->notPrivate();
        }

        return $packages->get();
    }

    /**
     * Scope a query to exclude private packages.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotPrivate($query)
    {
        return $query->where('is_private', 0);
    }


    public function businessType() {
        return $this->belongsTo(BusinessType::class, "business_type_id");
    }
 

    public function getPermissions() {
        return DB::table('package_has_permissions')
            ->where('package_id', $this->id);
    }

    public function chartAccounts() {
        return DB::table('chart_account_packages')
            ->where('package_id', $this->id);
    }

    public function canAccess($perm) {
        $permission = DB::table('business_type_permission')->where('name', $perm)->first();

        if (!$permission) {
            $permission = DB::table('business_type_permission')->insert([
                "name" => $perm,
                "title" => $perm,
                "category" => "pages",
                "order" => "0",
            ]);
        }

        return DB::table('package_has_permissions')
            ->where('package_id', $this->id)
            ->where('permission_id', optional($permission)->id)
            ->exists();
    }
}
