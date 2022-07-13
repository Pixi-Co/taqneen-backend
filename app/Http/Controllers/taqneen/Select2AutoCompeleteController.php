<?php

namespace App\Http\Controllers\taqneen;

use App\Contact;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Select2AutoCompeleteController extends Controller
{
    public function dataAjax(Request $request)
    {

        if($request->has('q') && !$request->has('searchInContacts')){
            $search = $request->q;
            $data =User::select("id","first_name","last_name")
                ->where('user_type',$request->user_type)
                ->where('first_name','LIKE',"%$search%")
                ->orWhere('last_name','LIKE',"%$search%")
                ->orWhere('custom_field_1','LIKE',"%$search%")
                ->get();
            return response()->json($data);
        }

        if ($request->has('q') && $request->has('searchInContacts'))
        {
            $search = $request->q;
            $data =Contact::select("id","supplier_business_name",'mobile',"name",'first_name','last_name','converted_by','custom_field1')
                ->where('supplier_business_name','LIKE',"%$search%")
                ->orWhere('name','LIKE',"%$search%")
                ->orWhere('first_name','LIKE',"%$search%")
                ->orWhere('last_name','LIKE',"%$search%")
                ->orWhere('custom_field1','LIKE',"%$search%")
                ->get();
            return response()->json($data);

        }

    }
}


//$data = [];
//if ($request->has('q')) {
//    $search = $request->q;
//    $data = User::couriers()->select(
//        "id",
//        "first_name",
//        "last_name",
//        DB::raw('CONCAT(IFNULL(first_name, ""), " ", IFNULL(last_name, ""), " ", IFNULL(custom_field_1, "")) as search_field')
//    )
//        ->where('user_type', $request->user_type)
//        ->having('search_field', 'LIKE', "%$search%")
//        ->take(60)
//        ->get();
//}
//return response()->json($data);
