<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class ExpenseCategory extends Model
{
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * 
     *  
     */ 
    public static function loadExpensesTypes($business_id) {
        foreach(DB::table('expenses_data')->get() as $row) {
            $item = ExpenseCategory::create([
                "name" => $row->name,
                "business_id" => $business_id  
            ]);

            $item->update([
                "code" => $item->id
            ]);
        }

        return true;
    }
}
