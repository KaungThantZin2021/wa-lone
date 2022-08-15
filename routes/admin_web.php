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
Route::name('admin.')
        ->prefix('/admin')
        ->namespace('App\Http\Controllers\Backend\Auth')
        ->group(function () {
            Route::get('/login', 'AdminLoginController@showLoginForm')->name('login');
            Route::post('/otp', 'AdminLoginController@showOtpForm')->name('otp');
            // Route::get('/otp', 'AdminLoginController@showOtpForm')->name('otp');
            Route::post('/login', 'AdminLoginController@login')->name('login');
            Route::post('/logout', 'AdminLoginController@logout')->name('logout');
        });

Route::name('admin.')
    ->prefix('/admin')
    ->middleware('auth:admin_user')
    ->namespace('App\Http\Controllers\Backend\Admin')
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
    
        // User
        Route::resource('/user', 'UserController');
        // End User

});
