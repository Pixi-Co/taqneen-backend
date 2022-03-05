<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    public static function setActiviationEmail_old(User $user) {
        $link = url('/verify-email?token=' . $user->remember_token);
        $message = view("emails.partial.activate", compact("link"))->render();
        $headerImg = url('/images/email_verify.png');
        return sendMailJet($user->email, "Verify your email", $message, $user->first_name, "", $headerImg);
    }

    public static function setActiviationEmail(User $user) {
        $link = url('/verify-email?token=' . $user->remember_token);
        $message = 'Alternatively paste the following URL into your browser:<br><a target="_blank" href="'.$link.'" >'.$link.'</a>';
        $headerImg = url('/images/email_verify.png');
        return sendMailJet($user->email, "Verify your email", $message, $user->first_name, "", $headerImg, "info@vauxerp.com", $link);
    }
}
