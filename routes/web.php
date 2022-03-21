<?php

use Illuminate\Support\Facades\Route;

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


Route::post('/userLogin', 'App\Http\Controllers\UserController@userLogin')->name('userLogin');
Route::get('/home', '\App\Http\Controllers\UserController@showHome')->name('home')->middleware('auth');

Route::get('/showUserPushMessages', '\App\Http\Controllers\UserController@showPushMessages');
Route::get('/showIdHelp', '\App\Http\Controllers\GeneralPagesController@showIdHelp');
Route::get('/showProjectInfo', '\App\Http\Controllers\GeneralPagesController@showProjectInfo');
Route::get('/showRecordingMethodExplanation', '\App\Http\Controllers\GeneralPagesController@showRecordingMethodExplanation');

Route::get('/visit', '\App\Http\Controllers\VisitController@visitIndex');
Route::get('/visit/{visit}', '\App\Http\Controllers\VisitController@visitShow');
Route::get('/visit/{visit}/edit', '\App\Http\Controllers\VisitController@visitShow');
Route::get('/visit/{visit}/delete', '\App\Http\Controllers\VisitController@visitShow');

Route::get('/adminLogin', 'App\Http\Controllers\AdminController@adminWelcome');
Route::post('/adminLogin', 'App\Http\Controllers\AdminController@adminLogin')->name('adminLogin');
Route::get('/adminHome', 'App\Http\Controllers\AdminController@adminHome');

Route::get('/regionCreate', 'App\Http\Controllers\AdminController@regionCreate');
Route::post('/regionCreate/{region}', '\App\Http\Controllers\AdminController@regionStore');
Route::get('/region/{region}', '\App\Http\Controllers\AdminController@regionEdit');
Route::get('/region', '\App\Http\Controllers\AdminController@regionIndex');

Route::get('/user/create/{userId}', '\App\Http\Controllers\AdminController@createUser');
Route::post('/user/create/{userId}', '\App\Http\Controllers\AdminController@storeUser');
Route::get('/user', '\App\Http\Controllers\AdminController@userIndex');
Route::post('/user/indexAjax', '\App\Http\Controllers\AdminController@userIndexAjax');

Route::get('/pushmessage', '\App\Http\Controllers\AdminController@pushMessageIndex');
Route::get('/pushmessage/create/{messageId}', '\App\Http\Controllers\AdminController@createPushmessage');
Route::post('/pushmessage/create/{messageId}', '\App\Http\Controllers\AdminController@storePushmessage');

Route::get('translationIndex', '\App\Http\Controllers\AdminController@translationIndex');
Route::get('translationEdit/{language}', '\App\Http\Controllers\AdminController@translationEdit');
Route::get('translationPutAjax', '\App\Http\Controllers\AdminController@translationPutAjax');

Route::get('/test', function () 
{
    return view('welcome');
});
Route::get('logoff', function() 
{
    Auth::logout();
    return view('adminLogin');
});
//Route::get("requestUserPackage", [UserController::class, 'requestUserPackage']);
Route::post("/requestUserPackage", 'App\Http\Controllers\UserController@requestUserPackage');


Route::get('/*', 'App\Http\Controllers\GeneralPagesController@welcome');
