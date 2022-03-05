<?php

namespace App\Triger;

use Illuminate\Database\Eloquent\Model;

class TrigerIntegration extends Model
{

    protected $table = "tr_integrations";

    /**
     * integration keys
     * 
     */
    public static $EMAIL = 1;
    public static $SMS = 2;
    public static $WHATSAPP = 3;

    /**
     * integration list
     * 
     */
    public static $INTEGRATIONS = [
        ["id" => 1, "name" => 'EMAIL'],
        ["id" => 2, "name" => 'SMS'],
        ["id" => 3, "name" => 'WHATSAPP'] 
    ];

    /**
     * insert integration list in db
     * 
     */
    public static function loadIntegrations() {
        self::truncate();
        foreach(self::$INTEGRATIONS as $item) {
            self::create([$item]);
        }
    }
}
