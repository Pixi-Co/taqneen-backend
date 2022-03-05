<?php

namespace App\Triger;

use Illuminate\Database\Eloquent\Model;

class TrigerNotifier extends Model
{
    
    public static function send($trigerName, $notifiers = []) {

    }

    private static function sendEmail($notifiers = []) {
        foreach($notifiers as $notifier) {
            $to = $notifier['notifier'];
            $subject = $notifier['subject'];
            $message = $notifier['message'];
            $name = "vauxerp";
            $sub_subject = null;
            $header_img = null;
            $footer = "";
            $from = "info@vauxerp.com";
            $link = "";
            sendMailJet($to, $subject, $message, $name, $sub_subject, $header_img, $footer, $from, $link);
        }
    }
}
