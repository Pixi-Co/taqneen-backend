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


//Routes for authenticated users only
Route::group([
    "middleware" => ['setData', 'auth', 'SetSessionData', 'language', 'timezone', 'CheckUserLogin'], 
    ], function () {

    
    Route::resource('tutorial', 'TutorialController');
    Route::get('tutorial/load/{tutorial}', 'TutorialController@load');
    Route::post('tutorial/complete/{tutorial}', 'TutorialController@complete');
    Route::post('tutorial/set-current/{tutorial}', 'TutorialController@setCurrent');
    Route::post('tutorial/end', 'TutorialController@endTutorial');

    
    Route::get('documentation', 'DocumentationController@index');
});
