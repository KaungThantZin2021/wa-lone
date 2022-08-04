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
// use App\Http\Controllers\Backend\Admin;

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
