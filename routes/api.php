<?php

use App\User;
use Illuminate\Http\Request; 

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/generate-username', function(){
    return User::max('id') + 1;
});

Route::post('/validate-email', function(){  
    return DB::table('users')->where('email', str_replace(' ', '', request()->email))->first()? '1' : '0';
});



Route::get('/verify', "UserController@verifyEmail");
Route::get('/invoice/{token}', 'SellPosController@showInvoice')->name('show_invoice_api');
Route::get('/business-types', "BussinessTypeController@get");
