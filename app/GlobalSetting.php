<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GlobalSetting extends Model
{ 

    public static function getActivityCodesOfEinvoice() {
        return json_decode(optional(DB::table('global_settings')->where('key', 'activity_codes_einvoice')->first())->value);
    }

    public static function getIssuerTypes() {
        return json_decode(optional(DB::table('global_settings')->where('key', 'issuer_types')->first())->value);
    }

    public static function getCountryCodes() {
        return json_decode(optional(DB::table('global_settings')->where('key', 'country_codes')->first())->value);
    }

    public static function getUnitCodes() {
        return json_decode(optional(DB::table('global_settings')->where('key', 'einvoice_unit_codes')->first())->value);
    }
    
    public static function getTaxCodes() {
        return json_decode(optional(DB::table('global_settings')->where('key', 'einvoice_tax_codes')->first())->value);
    }
}
