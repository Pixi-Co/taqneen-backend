<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BusinessType extends Model
{ 
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = "business_types";
   

    protected $fillable = [
        'name', 'slug', 'description', 'icon', 'active'
    ];

    public static function active() {
        return self::where('active', '1')->get();
    }

    public function getPermissions() {
        return DB::table('business_type_has_permission')
            ->where('business_type_id', $this->id);
    }

    public function chartAccounts() {
        return DB::table('chart_account_business_type')
            ->where('business_type_id', $this->id);
    }

    public static function permissionCategorys() {
        return DB::table('business_type_permission')->select('category')->distinct()->pluck('category')->toArray();
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

        return DB::table('business_type_has_permission')
            ->where('business_type_id', $this->id)
            ->where('permission_id', optional($permission)->id)
            ->exists();
    }

    public static function permissions() {
        return DB::table('business_type_permission');
    }

    public static function loadBusinessTypePermissions() {
        $permissions = [
            // pages category
            ["export_to_file", "Export To File", "pages"],
            ["import_from_file", "Import From File", "pages"],
            ["customer_group", "Customer Groups", "pages"],
            ["sales_commission_agent", "Sales Commission Agent", "pages"],

            // report category
            ["profit_loss_report", "Profit & Loss Report", "reports"],
            ["aging_report", "Aging Report", "reports"],
            ["income_statement_report", "Income Statement Report", "reports"],
            ["product_sell_report", "Product Sell Report", "reports"],
            ["tax_report", "Tax Report", "reports"],
            ["expense_report", "Expenses Report", "reports"],
            ["sell_payment_report", "Sell Payment Report", "reports"],
            ["purchase_sell_report", "Purchase & Sell Report", "reports"],
            ["sale_representative_report", "Sale Representative Report", "reports"],
            ["item_report", "Items Report", "reports"],
            ["stock_adjustment_report", "Stock Adjustment Report", "reports"],
            ["stock_expiry_report", "Stock Expiry Report", "reports"],
            ["stock_report", "Stock Report", "reports"],
            ["purchase_payment_report", "Purchase Payment Report", "reports"],
            ["product_purchase_report", "Product Purchase Report", "reports"],
            ["register_report", "Register Report", "reports"],
            ["trending_product_report", "Trending Products Report", "reports"],
            ["customer_group_report", "Customer Group Report", "reports"],
            ["customer_supplier_report", "Customer & Supplier Report", "reports"],
        ];

        DB::table('business_type_permission')->truncate();
        foreach ($permissions as $permission) {
            DB::table('business_type_permission')->insert([
                "name" => $permission[0],
                "title" => $permission[1],
                "category" => $permission[2]
            ]);
        }

        return true;
    }
 
}
