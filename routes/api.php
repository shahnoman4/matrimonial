<?php

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

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::post('forgot_password', 'API\UserController@forgotPassword');

Route::group(['middleware' => 'auth:api'], function(){
    
    Route::get('logout','API\UserController@logout')->name('logout');
    //Login User Routes
    Route::post('details', 'API\UserController@details');
    Route::get('loginUserdetail', 'API\UserController@loginUserdetails');
    Route::post('uploadAvatar', 'API\UserController@uploadAvatar')->name('uploadAvatar');
    Route::post('updateBasicInfo', 'API\UserController@updateBasicInfo')->name('updateBasicInfo');
    Route::post('updateAppearance', 'API\UserController@updateAppearance')->name('updateAppearance');
    Route::post('updateLifeStle', 'API\UserController@updateLifeStle')->name('updateLifeStle');
    Route::post('updatePersonality', 'API\UserController@updatePersonality')->name('updatePersonality');
    Route::post('updateInterest', 'API\UserController@updateInterest')->name('updateInterest');
    Route::put('editProfile', 'API\UserController@editProfile')->name('editProfile');
    Route::post('changePassword', 'API\UserController@changePassword')->name('changePassword');
    Route::get('earnPoint', 'API\UserController@earnPoint')->name('earnPoint');
    //Users Routes
    Route::get('getUser', 'API\FetchUserController@getUser');
    Route::get('getReceivedInterest', 'API\FetchUserController@getReceivedInterest');
    Route::get('getSendInterest', 'API\FetchUserController@getSendInterest');
    Route::post('storeInterest', 'API\FetchUserController@storeInterest');
    Route::get('getShortlist', 'API\FetchUserController@getShortlist');
    Route::post('storeShortlist', 'API\FetchUserController@storeShortlist');
    Route::get('getNewUser', 'API\FetchUserController@getNewUser');
    Route::get('getFeatureUser', 'API\FetchUserController@getFeatureUser');
    Route::get('getDailyRecommendedUser', 'API\FetchUserController@getDailyRecommendedUser');
    Route::get('getMyMatchesUser', 'API\FetchUserController@getMyMatchesUser');
    // Message send routes
    Route::post('createRoom', 'API\MessageController@createRoom');
    Route::post('sendMessage', 'API\MessageController@sendMessage');
    Route::post('getMessages', 'API\MessageController@getMessages');
    Route::get('getUsersChatRooms', 'API\MessageController@getUsersChatRooms');
    Route::post('deleteMessages', 'API\MessageController@deleteMessages');
    Route::post('chatRoomsDelete', 'API\MessageController@chatRoomsDelete');
    Route::post('blockUser', 'API\MessageController@blockUser');
    Route::post('reportUser', 'API\MessageController@reportUser');
    Route::post('storeSetting', 'API\SettingController@storeSetting');
    Route::get('getNotification', 'API\MessageController@getNotification');
    Route::get('readNotification', 'API\MessageController@readNotification');
    Route::post('unBlockUser', 'API\MessageController@unBlockUser');
    Route::get('getBlockUser', 'API\MessageController@getBlockUser');
    
    Route::put('user/{user}/online', 'API\UserOnlineController');
    Route::put('user/{user}/offline', 'API\UserOfflineController');
    
   // Route::middleware('auth:api')->put('user/{user}/online', 'UserOnlineController');
   // Route::middleware('auth:api')->put('user/{user}/offline', 'UserOfflineController');


});



