<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
 

class Triger { 
    public static $NEW_SUBSCRIPTION = "NEW_SUBSCRIPTION";
    public static $RENEW_SUBSCRIPTION = "RENEW_SUBSCRIPTION";
    public static $EXPIRE_SUBSCRIPTION_DAY = "EXPIRE_SUBSCRIPTION_DAY";
    public static $CHANGE_SUBSCRIPTION_STATUS = "CHANGE_SUBSCRIPTION_STATUS";
    public static $EXPIRE_SUBSCRIPTION_AFTER_3_WEEKS = "EXPIRE_SUBSCRIPTION_AFTER_3_WEEKS";
    public static $EXPIRE_SUBSCRIPTION_AFTER_2_WEEKS = "EXPIRE_SUBSCRIPTION_AFTER_2_WEEKS";
    public static $EXPIRE_SUBSCRIPTION_AFTER_1_WEEKS = "EXPIRE_SUBSCRIPTION_AFTER_1_WEEKS"; 
    public static $EXPIRE_SUBSCRIPTION_BEFORE_3_WEEKS = "EXPIRE_SUBSCRIPTION_BEFORE_3_WEEKS";
    public static $EXPIRE_SUBSCRIPTION_BEFORE_2_WEEKS = "EXPIRE_SUBSCRIPTION_BEFORE_2_WEEKS";
    public static $EXPIRE_SUBSCRIPTION_BEFORE_1_WEEKS = "EXPIRE_SUBSCRIPTION_BEFORE_1_WEEKS";
    public static $ADD_OPPORTUNITY = "ADD_OPPORTUNITY";

    public static function fire($triger, $subscriptionId) {
        EmailTemplate::send($triger, $subscriptionId);
    }

    public static function fire2($triger, $object) {
        EmailTemplate::send2($triger, $object);
    }
}
