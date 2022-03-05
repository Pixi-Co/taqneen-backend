<?php

namespace App\Http\Controllers;

use App\Translation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request, $action)
    {
        //$user = User::find(auth())
        //auth()->user()->attachPermission('superadmin');

        //$user = User::find(auth()->user()->id);
        //dump($user->hasPermissionTo('superadmin'));
        $this->$action();
    }

    public function email() {
        sendMail(request()->email, "test email", "welcome");
        echo "sendMain(): work !!!! <br>";
    }
}
