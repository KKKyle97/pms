<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// login API
Route::post('/ninjaspirits/login','GameController@login');
Route::post('/ninjaspirits/firstLogin','GameController@firstLogin');


// avatar API
Route::put('/ninjaspirits/changeAvatar','GameController@changeAvatar');
Route::post('/ninjaspirits/unlockAvatar','GameController@unlockAvatar');
Route::get('/ninjaspirits/{id}/getAvatars','GameController@getAvatars');

// badge API
Route::post('/ninjaspirits/unlockCoinBadge','GameController@unlockCoinBadge');
Route::post('/ninjaspirits/unlockAvatarBadge','GameController@unlockAvatarBadge');
Route::get('/ninjaspirits/{id}/getAllBadges','GameController@getAllBadges');

// Other API
Route::post('/ninjaspirits/updateScore','GameController@updateScore');
Route::get('/ninjaspirits/getScore','GameController@getScore');
Route::post('/ninjaspirits/sendReport','GameController@sendReport');
Route::post('/ninjaspirits/sendMessage','GameController@sendMessage');
Route::get('/ninjaspirits/{id}/loadProfile','GameController@loadProfile');
