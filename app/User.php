<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
use \Modules\Superadmin\Entities\Package;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HasRoles;
    use HasApiTokens;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    
    public function requireActivation() {
        $token = randToken();
        $this->remember_token = $token;
        $this->status = "inactive";


        // send activation email
        Email::setActiviationEmail($this); 
        
        $this->update(); 
    }

    public function verifyEmail() { 
        $this->status = "active";

        // send activation email
        $this->update();  
    }

    /**
     * Get the business that owns the user.
     */
    public function business()
    {
        return $this->belongsTo(\App\Business::class);
    }

    public function scopeUser($query)
    {
        return $query->where('users.user_type', 'user');
    }

    /**
     * The contact the user has access to.
     * Applied only when selected_contacts is true for a user in
     * users table
     */
    public function contactAccess()
    {
        return $this->belongsToMany(\App\Contact::class, 'user_contact_access');
    }

    /**
     * Get all of the users's notes & documents.
     */
    public function documentsAndnote()
    {
        return $this->morphMany('App\DocumentAndNote', 'notable');
    }

    /**
     * Creates a new user based on the input provided.
     *
     * @return object
     */
    public static function create_user($details)
    {
        $user = User::create([
                    'surname' => '-',
                    'first_name' => $details['first_name'],
                    'last_name' => $details['last_name'],
                    'username' => $details['username'],
                    'email' => $details['email'],
                    'businesstype_id' => isset($details['businesstype_id'])? $details['businesstype_id'] : null,
                    'bussiness_description' => isset($details['bussiness_description'])? $details['bussiness_description'] : null,
                    'password' => Hash::make($details['password']),
                    'google' => request()->google_id,
                    'language' => !empty($details['language']) ? $details['language'] : 'en'
                ]);

        return $user;
    }

    /**
     * Gives locations permitted for the logged in user
     *
     * @return string or array
     */
    public function permitted_locations()
    {
        $user = $this;

        if ($user->can('access_all_locations')) {
            return 'all';
        } else {
            $business_id = request()->session()->get('user.business_id');
            $permitted_locations = [];
            $all_locations = BusinessLocation::where('business_id', $business_id)->get();
            foreach ($all_locations as $location) {
                if ($user->can('location.' . $location->id)) {
                    $permitted_locations[] = $location->id;
                }
            }
            
            return $permitted_locations;
        }
    }

    /**
     * Returns if a user can access the input location
     *
     * @param: int $location_id
     * @return boolean
     */
    public static function can_access_this_location($location_id)
    {
        $permitted_locations = auth()->user()->permitted_locations();
        
        if ($permitted_locations == 'all' || in_array($location_id, $permitted_locations)) {
            return true;
        }

        return false;
    }

    public function scopeOnlyPermittedLocations($query)
    {
        $user = auth()->user();
        $permitted_locations = $user->permitted_locations();
        $is_admin = $user->hasAnyPermission('Admin#' . $user->business_id);
        if ($permitted_locations != 'all' && !$user->can('superadmin') && !$is_admin) {
            $permissions = ['access_all_locations'];
            foreach ($permitted_locations as $location_id) {
                $permissions[] = 'location.' . $location_id;
            }

            return $query->whereHas('permissions', function($q) use ($permissions) {
                $q->whereIn('permissions.name', $permissions);
            });

        } else {
            return $query;
        }
    }

    /**
     * Return list of users dropdown for a business
     *
     * @param $business_id int
     * @param $prepend_none = true (boolean)
     * @param $include_commission_agents = false (boolean)
     *
     * @return array users
     */
    public static function forDropdown($business_id, $prepend_none = true, $include_commission_agents = false, $prepend_all = false, $check_location_permission = false)
    {
        if (!$business_id) {
            $business_id = session('business.id');
        }

        $query = User::where('business_id', $business_id)
                    ->user();
                    
        if (!$include_commission_agents) {
            $query->where('is_cmmsn_agnt', 0);
        }

        if ($check_location_permission) {
            $query->onlyPermittedLocations();
        }

        $all_users = $query->select('id', DB::raw("CONCAT(COALESCE(surname, ''),' ',COALESCE(first_name, ''),' ',COALESCE(last_name,'')) as full_name"))->get();
        $users = $all_users->pluck('full_name', 'id');

        //Prepend none
        if ($prepend_none) {
            $users = $users->prepend(__('lang_v1.none'), '');
        }

        //Prepend all
        if ($prepend_all) {
            $users = $users->prepend(__('lang_v1.all'), '');
        }
        
        return $users;
    }

    /**
    * Return list of sales commission agents dropdown for a business
    *
    * @param $business_id int
    * @param $prepend_none = true (boolean)
    *
    * @return array users
    */
    public static function saleCommissionAgentsDropdown($business_id, $prepend_none = true)
    {
        $all_cmmsn_agnts = User::where('business_id', $business_id)
                        ->where('is_cmmsn_agnt', 1)
                        ->select('id', DB::raw("CONCAT(COALESCE(surname, ''),' ',COALESCE(first_name, ''),' ',COALESCE(last_name,'')) as full_name"));

        $users = $all_cmmsn_agnts->pluck('full_name', 'id');

        //Prepend none
        if ($prepend_none) {
            $users = $users->prepend(__('lang_v1.none'), '');
        }

        return $users;
    }

    /**
     * Return list of users dropdown for a business
     *
     * @param $business_id int
     * @param $prepend_none = true (boolean)
     * @param $prepend_all = false (boolean)
     *
     * @return array users
     */
    public static function allUsersDropdown($business_id, $prepend_none = true, $prepend_all = false)
    {
        $all_users = User::where('business_id', $business_id)
                        ->select('id', DB::raw("CONCAT(COALESCE(surname, ''),' ',COALESCE(first_name, ''),' ',COALESCE(last_name,'')) as full_name"));

        $users = $all_users->pluck('full_name', 'id');

        //Prepend none
        if ($prepend_none) {
            $users = $users->prepend(__('lang_v1.none'), '');
        }

        //Prepend all
        if ($prepend_all) {
            $users = $users->prepend(__('lang_v1.all'), '');
        }

        return $users;
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getUserFullNameAttribute()
    {
        return "{$this->surname} {$this->first_name} {$this->last_name}";
    }

    /**
     * Return true/false based on selected_contact access
     *
     * @return boolean
     */
    public static function isSelectedContacts($user_id)
    {
        $user = User::findOrFail($user_id);

        return (boolean)$user->selected_contacts;
    }

    public function getRoleNameAttribute()
    {
        $role_name_array = $this->getRoleNames();
        $role_name = !empty($role_name_array[0]) ? explode('#', $role_name_array[0])[0] : '';
        return $role_name;
    }

    public function media()
    {
        return $this->morphOne(\App\Media::class, 'model');
    }

    /**
     * Find the user instance for the given username.
     *
     * @param  string  $username
     * @return \App\User
     */
    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }

    /**
     * Get the contact for the user.
     */
    public function contact()
    {
        return $this->belongsTo(\Modules\Crm\Entities\CrmContact::class, 'crm_contact_id');
    }
    

    /**
     * Get the contact for the user.
     */
    public function can_access_custom($module_name, $mode='default')
    {
        $active_sub = $this->business->getCurrentActiveSubs();
        $can_access_products = 0;
        $products_custom_perm_name = 'products';
        if($active_sub){
            $package_id = $active_sub->package_id;
            $package = Package::find($package_id);
            if($package){
                if($mode == 'empty'){
                    $module = DB::table('pos_modules')->where('slug', $module_name)->get()->first();
                    if($module){
                        $id = $module->id;
                        $sub_modules = DB::table('pos_modules')->where('parent', $module->id)->get()->toArray();
                        $flag = 0;
                        foreach($sub_modules as $sub_module){
                            if(isset($package->custom_permissions[$sub_module->slug]) && $package->custom_permissions[$sub_module->slug]){
                                $flag = 1;
                            }
                        }
                        if($flag){
                            $can_access_products = 1;
                        }
                    }
                } else {
                    if(isset($package->custom_permissions[$module_name]) && $package->custom_permissions[$module_name]){
                        $can_access_products = 1;
                    }
                }
            }
        }
        return $can_access_products;
    }
}
