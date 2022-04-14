<?php

namespace App\Forms;
  
use App\CustomerForm;
use App\System; 

class FormRouter
{ 
    private static $instance;

    private function __constrct() {

    }

    public static function getInstance() {
        if (!self::$instance)
            self::$instance = new FormRouter();
        
        return self::$instance;
    }

    public function load() {
        $action = request()->action; 

        switch ($action) {
            case 'FORM-GENERATOR-API':
                return FormGenerator::formGeneratorApi();
                break;

            case 'FORM-GENERATOR-INDEX':
                return FormGenerator::formGeneratorIndex();
                break;
            
            default:
                echo "no-thing";
                break;
        }
    }
 
}
