<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\PatientController;

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



Route::group(['middleware' => 'guest'], function() {
    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');


    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
});

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'],function(){
    Route::get('/', 'HomeController@index')->name('home');
    
    Route::any('/patients/search', 'PatientController@search')->name('patients.search');
    Route::get('/patients/{id}/analyse','PatientController@analyse')->name('patients.analyse');
    Route::resource('patients', 'PatientController');
    Route::any('/notifications/search', 'NotificationController@search')->name('notifications.search');
    Route::resource('notifications', 'NotificationController')->only([
        'index', 'update'
    ]);
    Route::resource('users', 'UserController')->only([
        'show', 'edit', 'update'
    ]);
    Route::get('change-password', 'ChangePasswordController@index')->name('passwords.index');
    Route::put('change-password', 'ChangePasswordController@update')->name('passwords.update');
});



Route::any('{query}', 
  function() { return redirect()->route('home')->withErrors(['Invalid URL entered!', 'Invalid URL']); })
  ->where('query', '.*');


