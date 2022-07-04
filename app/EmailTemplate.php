<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmailTemplate extends Model
{

    protected $table = "notification_templates";

    public static $TRIGERS = [
        "NEW_SUBSCRIPTION" => "إضافة اشتراك جديد",
        "CHANGE_SUBSCRIPTION_STATUS" => "تغيير حالة الاشتراك",
        "RENEW_SUBSCRIPTION" => "تجديد الاشتراك",
        "EXPIRE_SUBSCRIPTION_BEFORE_3_WEEKS" => "الاشتراك ينتهي قبل 3 اسابيع",
        "EXPIRE_SUBSCRIPTION_BEFORE_2_WEEKS" => "تنتهي صلاحية الاشتراك قبل أسبوعين",
        "EXPIRE_SUBSCRIPTION_BEFORE_1_WEEKS" => "تنتهي صلاحية الاشتراك قبل أسبوع واحد",
        "EXPIRE_SUBSCRIPTION_DAY" => "يوم انتهاء الاشتراك",
        "EXPIRE_SUBSCRIPTION_AFTER_3_WEEKS" => "الاشتراك ينتهي بعد 3 اسابيع",
        "EXPIRE_SUBSCRIPTION_AFTER_2_WEEKS" => "الاشتراك ينتهي بعد اسبوعين",
        "EXPIRE_SUBSCRIPTION_AFTER_1_WEEKS" => "تنتهي صلاحية الاشتراك بعد أسبوع واحد",
        "ADD_OPPORTUNITY" => "أضافة الفرص",
        "ADD_CUSTOMER_FORM" => "إضافة نموذج العميل",
        "ADD_SUBSCRIPTION_NOTE" => "إضافة ملاحظة الاشتراك",
    ];

    public static function getStatusAllowSendMail()
    {
        $statues = TicketStatus::where('is_send_mail',1)->pluck('name','name')->toArray();
        foreach ($statues as $key=>$value)
        {
            self::$TRIGERS[strtoupper($key)] = "Ticket status ".$value;
        }
    }

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
        '{subscription_note}' => "note",
        '{ticket_id}' => "id",
        '{ticket_url}' => "status_id",
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
//            ->where('business_id', session('business.id'))
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
  
        foreach($emailList as $data) { 
            try {
                $res = sendMailJet($data['to'], $data['subject'], $data['body'], $data['title'], null, "/images/img-25.jpg", "", $data['from']);
                  
            } catch (\Exception $th) { 
 
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

