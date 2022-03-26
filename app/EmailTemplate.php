<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmailTemplate extends Model
{
    
    public static $TRIGERS = [
        "NEW_SUBSCRIPTION" => "add new subscription",
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
        '{sales_commission}' => "sales_commission",
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

    public static function getEmailOfCourier(Subscription $subscription) {
        return optional($subscription->user)->email;
    }

    public static function getEmail($triger, Subscription $subscription) {
        $resource = self::getTemplate($triger);
        $body = $resource->email_body;
        $cc = $resource->cc;
        $emailList = explode(",", $cc);
        $emailList[] = optional($subscription->contact)->email;
        $emails = [];

        if (self::getEmailOfCourier($subscription)) {
            $emailList[] = self::getEmailOfCourier($subscription);
        }

        foreach(self::$TAGS as $key => $value) {
            $body = str_replace($key, $subscription->getTagValue($value), $body);
        } 

        foreach($emailList as $item) {
            $email = str_replace(" ", "", $item);
            if (strlen($email) > 1)
            $emails[] = [
                "title" => "taqneen",
                "from" => "hello@elwatnia.in",
                "to" => $email,
                "subject" => $resource->subject,
                "body" => $body,
                "name" => "taqneen",
            ];
        }

        return $emails;
    }

    public static function send($triger, $subscriptionId) {
        $subscription = Subscription::find($subscriptionId);
        $emailList = self::getEmail($triger, $subscription);

        foreach($emailList as $data) { 
            try {
                sendMailJet($data['to'], $data['subject'], $data['body'], $data['title'], null, "/images/img-25.jpg", "", $data['from']);
            } catch (\Exception $th) { 
            }
        } 
    }
}

 