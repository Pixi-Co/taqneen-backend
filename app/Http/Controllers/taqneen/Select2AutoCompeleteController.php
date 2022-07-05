<?php

namespace App\Http\Controllers\taqneen;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class Select2AutoCompeleteController extends Controller
{
    public function dataAjax(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data =User::select("id","first_name","last_name")
                ->where('user_type',$request->user_type)
                ->where('first_name','LIKE',"%$search%")
                ->orWhere('last_name','LIKE',"%$search%")
                ->orWhere('custom_field_1','LIKE',"%$search%")
                ->get();
        }
        return response()->json($data);
    }
}
