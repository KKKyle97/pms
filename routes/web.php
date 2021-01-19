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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/patients/search/', 'PatientController@search')->name('patients.search');
Route::get('/patients/{id}/analyse','PatientController@analyse')->name('patients.analyse');
Route::resource('patients', 'PatientController');
Route::resource('notifications', 'NotificationController');
Route::resource('users', 'UserController');

Route::get('change-password', 'ChangePasswordController@index')->name('passwords.index');
Route::put('change-password', 'ChangePasswordController@update')->name('passwords.update');

