<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmailTemplate extends Model
{

    protected $table = "notification_templates";
    
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
        "ADD_OPPORTUNITY" => "add opportunities",
        "ADD_CUSTOMER_FORM" => "add customer form",
        "ADD_SUBSCRIPTION_NOTE" => "add subscription note",
    ];

    public static $TAGS = [
        '{status}' => "status",
        '{customer}' => "contact_name",
        '{company}' => "company",
        '{sales_commission}' => "sales_commission",
        '{final_total}' => "final_total",
        '{payment_method}' => "payment_method",
        '{subscription_date}' => "transaction_date",
        '{pay_date}' => "paid_on",
        '{renew_date}' => "renew_date",
        '{expire_date}' => "expire_date",
        '{invoice_url}' => "invoice_url",
        '{subscription_url}' => "subscription_url",
        '{customer_form_name}' => "customer_form_name",
        '{customer_form_user}' => "customer_form_user",
        '{customer_form_pdf_url}' => "customer_form_pdf_url",
        '{customer_form_pdf}' => "customer_form_pdf",
        '{customer_form_upload_page}' => "customer_form_upload_page",
        '{user_triger_email}' => "user_triger_email",
        '{subscription_note}' => "note"
    ];
    
    public static function getTemplate($triger) {
        $resource = DB::table('notification_templates')
            ->where('business_id', session('business.id'))
            ->where('template_for', $triger)
            ->first();

        return $resource? $resource : new EmailTemplate(); 
    }

    public static function getEmailOfCourier($subscription) {
        return optional(optional($subscription)->user)->email;
    }

    public static function checkIfTagOrEmail($text, $subscription) {
        $text = str_replace(" ", "", $text);

        if ($text == "{sales_commision_email}") {
            return optional($subscription->user)->email;
        }

        if ($text == "{customer_email}") {
            return optional($subscription->contact)->email;
        }

        if ($text == "{customer_form_user_email}") {
            return optional($subscription->user)->email;
        }

        if ($text == "{user_triger_email}") {
            return optional($subscription)->user_triger_email;
        }

        return $text;
    }

    public static function getEmail($triger, $subscription) {
        $resources = DB::table('notification_templates')
            ->where('business_id', session('business.id'))
            ->where('template_for', $triger)
            ->get();
        
        $emails = [];
    
        foreach($resources as $resource) {   
            $body = $resource->email_body;
            $cc = $resource->cc;
            $emailList = explode(",", $cc);
            //$emailList[] = optional($subscription->contact)->email;
    
            //if (self::getEmailOfCourier($subscription)) {
                //$emailList[] = self::getEmailOfCourier($subscription);
            //}
    
            foreach(self::$TAGS as $key => $value) {
                $body = str_replace($key, $subscription->getTagValue($value), $body);
            } 
    
            foreach($emailList as $item) {
                $email = self::checkIfTagOrEmail($item, $subscription);
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
        }


        return $emails;
    }

    public static function send($triger, $subscriptionId) {
        $subscription = Subscription::find($subscriptionId);
        $emailList = self::getEmail($triger, $subscription);
 
        dd($emailList);
        foreach($emailList as $data) { 
            try {
                $res = sendMailJet($data['to'], $data['subject'], $data['body'], $data['title'], null, "/images/img-25.jpg", "", $data['from']);
                 
                dd($res);
            } catch (Exception $th) { 

                dd($th->getMessage());
            }
        } 
    }

    public static function send2($triger, $object) {
        $emailList = self::getEmail($triger, $object);
 
        //dd($emailList);
        foreach($emailList as $data) { 
            try {
                $res = sendMailJet($data['to'], $data['subject'], $data['body'], $data['title'], null, "/images/img-25.jpg", "", $data['from']);
                 
            } catch (\Exception $th) { 

                //dd($th->getMessage());
            }
        } 
    }
}

 