<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmailTemplate extends Model
{
    
    public static $TRIGERS = [
        "CHANGE_SUBSCRIPTION_STATUS" => "change subscription status",
        "RENEW_SUBSCRIPTION" => "renew subscription", 
        "EXPIRE_SUBSCRIPTION_BEFORE_3_WEEKS" => "expire subscription before 3 week",
        "EXPIRE_SUBSCRIPTION_BEFORE_2_WEEKS" => "expire subscription before 2 week",
        "EXPIRE_SUBSCRIPTION_BEFORE_1_WEEKS" => "expire subscription before 1 week",
        "EXPIRE_SUBSCRIPTION_DAY" => "expire subscription day",
        "EXPIRE_SUBSCRIPTION_AFTER_3_WEEKS" => "expire subscription after 3 week",
        "EXPIRE_SUBSCRIPTION_AFTER_2_WEEKS" => "expire subscription after 2 week",
        "EXPIRE_SUBSCRIPTION_AFTER_1_WEEKS" => "expire subscription after 1 week",
    ];

    public static $TAGS = [
        '{status}' => "status",
        '{customer}' => "contact_name",
        '{sales_commission}' => "user",
        '{final_total}' => "final_total",
        '{payment_method}' => "payment_method",
        '{subscription_date}' => "transaction_date",
        '{pay_date}' => "paid_on",
        '{renew_date}' => "renew_date",
        '{expire_date}' => "expire_date"
    ];
    
    public static function getTemplate($triger) {
        $resource = DB::table('notification_templates')
            ->where('business_id', session('business.id'))
            ->where('template_for', $triger)
            ->first();

        return $resource? $resource : new EmailTemplate(); 
    }

    public static function getEmail($triger, Subscription $subscription) {
        $resource = self::getTemplate($triger);
        $body = $resource->email_body;

        foreach(self::$TAGS as $key => $value) {
            $body = str_replace($key, $subscription->getTagValue($value), $body);
        }

        return [
            "from" => "hello@elwatnia.in",
            "to" => optional($subscription->contact)->email,
            "subject" => $resource->subject,
            "body" => $body,
            "name" => "taqneen",
        ];
    }

    public static function send($triger, $subscriptionId) {
        $subscription = Subscription::find($subscriptionId);
        $data = self::getEmail($triger, $subscription);
        
        sendMailJet($data['to'], $data['subject'], $data['body'], $data['title'], null, "/images/img-25.jpg", "", $data['from']);
    }
}


class Triger { 
    public static $RENEW_SUBSCRIPTION = "RENEW_SUBSCRIPTION";
    public static $EXPIRE_SUBSCRIPTION_DAY = "EXPIRE_SUBSCRIPTION_DAY";
    public static $CHANGE_SUBSCRIPTION_STATUS = "CHANGE_SUBSCRIPTION_STATUS";
    public static $EXPIRE_SUBSCRIPTION_AFTER_3_WEEKS = "EXPIRE_SUBSCRIPTION_AFTER_3_WEEKS";
    public static $EXPIRE_SUBSCRIPTION_AFTER_2_WEEKS = "EXPIRE_SUBSCRIPTION_AFTER_2_WEEKS";
    public static $EXPIRE_SUBSCRIPTION_AFTER_1_WEEKS = "EXPIRE_SUBSCRIPTION_AFTER_1_WEEKS"; 
    public static $EXPIRE_SUBSCRIPTION_BEFORE_3_WEEKS = "EXPIRE_SUBSCRIPTION_BEFORE_3_WEEKS";
    public static $EXPIRE_SUBSCRIPTION_BEFORE_2_WEEKS = "EXPIRE_SUBSCRIPTION_BEFORE_2_WEEKS";
    public static $EXPIRE_SUBSCRIPTION_BEFORE_1_WEEKS = "EXPIRE_SUBSCRIPTION_BEFORE_1_WEEKS";

    public static function fire($triger, $subscriptionId) {
        EmailTemplate::send($triger, $subscriptionId);
    }
}
