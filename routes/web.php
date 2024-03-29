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

Route::get('/showLoginScreen', 'App\Http\Controllers\UserController@showLogin')->name('showLogin')->middleware('guest');
Route::post('/userLogin', 'App\Http\Controllers\UserController@userLogin')->name('userLogin');
Route::get('/register', 'App\Http\Controllers\UserController@showRegister')->name('showRegister')->middleware('guest');
Route::post('/registerUser', 'App\Http\Controllers\UserController@registerUser')->name('registerUser');
Route::get('/home', '\App\Http\Controllers\UserController@showHome')->name('home')->middleware('auth');
Route::get('/settings', '\App\Http\Controllers\UserController@showSettings')->name('settings')->middleware('auth');
Route::get('/userLoginWithToken', 'App\Http\Controllers\UserController@userLoginWithToken');

Route::get('/changePassword', '\App\Http\Controllers\UserController@changePassword')->name('changePassword')->middleware('auth');
Route::post('/savePassword', '\App\Http\Controllers\UserController@savePassword')->name('savePassword')->middleware('auth');

Route::get('/forgotPassword', '\App\Http\Controllers\UserController@showForgotPassword')->name('pasword.request')->middleware('guest');
Route::post('/forgotPassword', '\App\Http\Controllers\UserController@emailPassword')->name('password.email');

Route::get('/resetPassword/{token}', '\App\Http\Controllers\UserController@resetPassword')->name('password.reset')->middleware('guest');
Route::post('/resetPassword', '\App\Http\Controllers\UserController@resetPasswordSave');

Route::get('/showUserPushMessages', '\App\Http\Controllers\UserController@showPushMessages');
Route::get('/showIdHelp', '\App\Http\Controllers\GeneralPagesController@showIdHelp');
Route::get('/showProjectInfo', '\App\Http\Controllers\GeneralPagesController@showProjectInfo');
Route::get('/showRecordingMethodExplanation', '\App\Http\Controllers\GeneralPagesController@showRecordingMethodExplanation');
Route::get('/news', '\App\Http\Controllers\GeneralPagesController@showNews')->name('news');
Route::get('/news/{newsItem}', '\App\Http\Controllers\GeneralPagesController@showNewsItem');
Route::get('/logOff', '\App\Http\Controllers\GeneralPagesController@logoff');
Route::get('/logoff', '\App\Http\Controllers\GeneralPagesController@logoff');

Route::get('/visit', '\App\Http\Controllers\VisitController@visitIndex');
Route::get('/visit/{visit}', '\App\Http\Controllers\VisitController@visitShow');
Route::get('/visit/{visit_id}/{visitType}/create', '\App\Http\Controllers\VisitController@visitCreate');
Route::post('/visit/store/{visit_id}', '\App\Http\Controllers\VisitController@visitStore');
Route::get('/visit/{visit}/edit', '\App\Http\Controllers\VisitController@visitEdit');
Route::delete('/visit/{visit}/delete', '\App\Http\Controllers\VisitController@visitDelete');

Route::get('/adminLogin', 'App\Http\Controllers\AdminController@adminWelcome');
Route::post('/adminLogin', 'App\Http\Controllers\AdminController@adminLogin')->name('adminLogin');
Route::get('/adminHome', 'App\Http\Controllers\AdminController@adminHome');
Route::get('/admin/rapi', 'App\Http\Controllers\AdminController@handleRApiRequest');
Route::get('/admin/loginAsUser/{user}', 'App\Http\Controllers\AdminController@loginAsUser');

Route::get('/regionCreate', 'App\Http\Controllers\AdminController@regionCreate');
Route::post('/regionCreate/{region}', '\App\Http\Controllers\AdminController@regionStore');
Route::get('/region/{region}', '\App\Http\Controllers\AdminController@regionEdit');
Route::get('/region', '\App\Http\Controllers\AdminController@regionIndex');
Route::get('/regionPublicIndex', '\App\Http\Controllers\GeneralPagesController@regionPublicIndex');
Route::get('/regionPublicShow/{region}', '\App\Http\Controllers\GeneralPagesController@regionPublicShow');

Route::get('/user/create/{userId}', '\App\Http\Controllers\AdminController@createUser');
Route::post('/user/create/{userId}', '\App\Http\Controllers\AdminController@storeUser');
Route::get('/user', '\App\Http\Controllers\AdminController@userIndex');
Route::post('/user/indexAjax', '\App\Http\Controllers\AdminController@userIndexAjax');
Route::post('/user/setUserSettingsAjax', '\App\Http\Controllers\UserController@setUserSettingsAjax');
Route::post('/user/setUserRecordingLevelAjax', '\App\Http\Controllers\UserController@setUserRecordingLevelAjax');
Route::get('/user/dataDownload', '\App\Http\Controllers\UserController@serveDataDownload');
Route::get('/user/badges/{user}', '\App\Http\Controllers\UserController@showBadges');
Route::get('/user/stats/{user}', '\App\Http\Controllers\UserController@showUserStats');
Route::get('/user/stats/{user}/ajaxGraphData', '\App\Http\Controllers\UserController@userStatsAjaxData');


Route::get('/pushmessage', '\App\Http\Controllers\AdminController@pushMessageIndex');
Route::get('/pushmessage/create/{messageId}', '\App\Http\Controllers\AdminController@createPushmessage');
Route::post('/pushmessage/create/{messageId}', '\App\Http\Controllers\AdminController@storePushmessage');

Route::get('/newsItem', '\App\Http\Controllers\AdminController@newsItemIndex')->name('newsindex');
Route::get('/newsItem/create/{messageId}', '\App\Http\Controllers\AdminController@createNewsItem');
Route::post('/newsItem/create/{messageId}', '\App\Http\Controllers\AdminController@storeNewsItem');

Route::get('/translationIndex', '\App\Http\Controllers\AdminController@translationIndex');
Route::get('/translationEdit/{language}', '\App\Http\Controllers\AdminController@translationEdit');
Route::get('/speciesTranslationEdit/{language}', '\App\Http\Controllers\AdminController@speciesTranslationEdit');
Route::get('/translationPutAjax', '\App\Http\Controllers\AdminController@translationPutAjax');
Route::get('/speciesTranslationPutAjax', '\App\Http\Controllers\AdminController@speciesTranslationPutAjax');

Route::post("/requestUserPackage", 'App\Http\Controllers\UserController@requestUserPackage');

Route::get('/', '\App\Http\Controllers\GeneralPagesController@start');
Route::get('/*', '\App\Http\Controllers\GeneralPagesController@showNews');

Route::get('/game/getLandscapeAjax', '\App\Http\Controllers\GameController@getLandscapeAjax');





Route::get('/test', '\App\Http\Controllers\GeneralPagesController@test');