<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TransKey extends Model
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = "trans_keys";


    protected $fillable = [
        'key', 'trans'
    ];

    public static function insertKey($key, $trans=null) {
        try { 
            // store key in database first
            TransKey::create([
                "key" => $key,
                "trans" => $trans,
            ]);  
        } catch (\Exception $th) {
            
        }  
    }
}
