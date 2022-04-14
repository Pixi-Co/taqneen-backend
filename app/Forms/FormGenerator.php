<?php

namespace App\Forms;
  
use App\CustomerForm;
use App\System; 

class FormGenerator
{ 
    public static function formGeneratorApi() {
        return '{}';
    }

    public static function formGeneratorIndex() {
        $keys = CustomerForm::$KEYS;
        $key = request()->key? request()->key . "_FORM" : CustomerForm::$KEYS[0] . "_FORM";
        $resource = System::where('key', $key)->first(); 
        $resource = !$resource? System::create(["key" => $key, "value" => request()->value?? '']) : $resource;
        
        if (request()->ajax()) {
            if (request()->value) {
                $resource->update([
                    "value" => request()->value
                ]);
            }
            return $resource->refresh();
        }


        return view('__forms.form_generator', compact("resource", "keys"));
    }
  
}
