<?php

namespace App\Http\Controllers\taqneen;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Select2AutoCompeleteController extends Controller
{
    public function dataAjax(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = User::couriers()->select(
                "id",
                "first_name",
                "last_name",
                DB::raw('(CONCAT(first_name, " ", last_name, " ", custom_field_1)) as search_field')
            )
            ->where('user_type', $request->user_type)
            ->having('search_field', 'LIKE', "%$search%")
            ->take(60)
            ->get();
        }
        return response()->json($data);
    }
}
