<?php

namespace App\Http\Controllers\taqneen;

use App\EmailTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subscription;
use App\Triger;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NotificationTemplateController extends Controller
{


    public function index() { 
        $resources = EmailTemplate::get();  
        return view('taqneen.notification.index', compact('resources'));
    }


    public function create() { 
        $trigers = EmailTemplate::$TRIGERS;
        $tags = EmailTemplate::$TAGS;
        $instance = EmailTemplate::class;
        return view('taqneen.notification.form', compact('trigers', 'instance', 'tags'));
    }

    public function save(Request $request) {
        $template_for = $request->template_for;
        $resource = DB::table('notification_templates')->find($request->id); /*DB::table('notification_templates')
            ->where('business_id', session('business.id'))
            ->where('template_for', $template_for)
            ->first();*/
        
        $data = [
            "template_for" => $template_for,
            "subject" => $request->subject,
            "email_body" => $request->email_body,
            "cc" => $request->cc,
            "business_id" => session('business.id')
        ];

        if (!$resource) {
            DB::table('notification_templates')->insert($data);
        } else {
            DB::table('notification_templates')
            ->where('business_id', session('business.id'))
            ->where('template_for', $template_for)
            ->update($data);
        }

        return responseJson(1, __('done'));
    }
}
