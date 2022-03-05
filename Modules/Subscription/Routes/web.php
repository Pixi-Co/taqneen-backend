<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('rate-trainer/{id}', 'TrainerController@rate'); 
Route::get('set-rate/{id}', 'RateController@rate');  
Route::post('set-rate/{id}', 'RateController@postRate'); 
Route::get('multi-rate', 'RateController@multirate'); 
Route::post('multi-rate', 'RateController@postMultirate'); 

Route::group([
    "middleware" => ['setData', 'auth', 'SetSessionData', 'language', 'timezone', 'CheckUserLogin'], 
    "prefix" => "sub"
    ], function () {

    
    Route::get('/', 'SubscriptionController@index'); 
    Route::post('/stop-subscription', 'SubscriptionController@stopSubscription'); 
    Route::post('/renew-subscription', 'SubscriptionController@renewSubscription'); 

    Route::get('/receiption', 'SubscriptionController@receiption'); 
    Route::get('/report/attendance', 'ReportController@attendance'); 
    Route::get('/report/trainer', 'ReportController@trainer'); 
    Route::get('/report/trainer-percents', 'ReportController@trainerPercent'); 
    Route::get('/report/subscription', 'ReportController@subscription'); 
    Route::get('/report/measurement', 'ReportController@measurement'); 
    Route::get('/report/rate', 'ReportController@rates'); 

    Route::get('class-type', 'ClassTypeController@index'); 
    Route::post('class-type/save', 'ClassTypeController@save'); 
    Route::post('class-type/{id}', 'ClassTypeController@destroy'); 

    Route::get('football-order', 'FootballOrderController@index'); 
    Route::post('football-order/save', 'FootballOrderController@save'); 
    Route::post('football-order/{id}', 'FootballOrderController@destroy');

    Route::get('measurment', 'MeasurmentController@index'); 
    Route::post('measurment/save', 'MeasurmentController@save'); 
    Route::post('measurment/{id}', 'MeasurmentController@destroy'); 
 

    Route::get('rate', 'RateController@index'); 
    Route::post('rate/save', 'RateController@save'); 
    Route::post('rate/{id}', 'RateController@destroy');
    Route::get('rate/show/{id}', 'RateController@show');

    Route::get('member', 'MemberController@index'); 
    Route::post('member/save', 'MemberController@save'); 
    Route::get('member/show/{id}', 'MemberController@show'); 
    Route::post('member/{id}', 'MemberController@destroy'); 
    Route::post('member/check-in/{id}', 'MemberController@checkIn'); 
 

    Route::get('trainer', 'TrainerController@index'); 
    Route::post('trainer/save', 'TrainerController@save'); 
    Route::post('trainer/{id}', 'TrainerController@destroy');
    Route::get('trainer/show/{id}', 'TrainerController@show');
    Route::get('rate-trainer/{id}', 'TrainerController@rate'); 
    Route::post('rate-trainer/{id}', 'TrainerController@postRate'); 
    Route::post('trainer/check-in/{id}', 'TrainerController@checkIn'); 
    Route::post('rate-trainer/{id}', 'TrainerController@postRate'); 

    Route::get('member-measurement', 'MemberMeasurementController@index'); 
    Route::post('member-measurement/save', 'MemberMeasurementController@save'); 
    Route::get('member-measurement/show/{id}', 'MemberMeasurementController@show'); 
    Route::post('member-measurement/{id}', 'MemberMeasurementController@destroy');

    Route::get('session', 'SessionController@index'); 
    Route::post('session/save', 'SessionController@save'); 
    Route::get('session/show/{id}', 'SessionController@show'); 
    Route::post('session/{id}', 'SessionController@destroy');
    
    Route::get('calendar/get', 'CalendarController@get');
    
    Route::get('subscription', 'ManageSubscriptionController@index');

});

