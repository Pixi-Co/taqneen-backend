<?php

use App\Module;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Modules\Superadmin\Entities\SubscriptionDetail;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = ['brand', 'category', 'sub_category', 'product_brochure', 'product_description', 'enable_sr_no', 'not_for_selling', 'rack_row_position_details', 'custom_field'];
       // $permissions = ['list', 'create', 'view', 'update', 'delete'];

        foreach ($modules as $module){
           // foreach ($permissions as $permission){
           //     $slug = $module . '.' . $permission;
           //     $name = $permission . ' ' . $module;
                Module::updateOrCreate([
                        'slug' => $module
                    ],[
                        'name' => Str::title(str_replace('_', ' ', $module))
                    ]
                );
           // }
        }
    }
}
