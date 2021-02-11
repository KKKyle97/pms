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

Route::post('/ninjaspirits/login','GameController@login');
Route::post('/ninjaspirits/firstLogin','GameController@firstLogin');
Route::post('/ninjaspirits/unlockCoinBadge','GameController@unlockCoinBadge');
//not implemented yet
Route::post('/ninjaspirits/buyAvatar','GameController@buyAvatar');

Route::post('/ninjaspirits/updateScore','GameController@updateScore');
Route::post('/ninjaspirits/sendMessage','GameController@sendMessage');
Route::get('/ninjaspirits/getScore','GameController@getScore');
Route::get('/ninjaspirits/getAvatars','GameController@getAvatars');
Route::get('/ninjaspirits/{id}/loadProfile','GameController@loadProfile');
