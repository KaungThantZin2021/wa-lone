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
            Route::post('/login', 'AdminLoginController@login')->name('login');
            Route::get('/otp', 'AdminLoginController@showOTPForm')->name('otp');
            Route::post('/resend-otp', 'AdminLoginController@resendOTP')->name('resend-otp');
            Route::post('/two-step-login', 'AdminLoginController@twoStepLogin')->name('two-step-login');
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

        //Admin User
        Route::resource('/admin-user', 'AdminUserController');
        // End Admin User

        //Admin User
        Route::resource('/blog', 'BlogController');
        Route::post('/blog/{id}/restore', 'BlogController@restore')->name('blog.restore');
        Route::delete('/blog/{id}/force-delete', 'BlogController@forceDelete')->name('blog.force-delete');
        // End Admin User

        // Activity Log
        Route::resource('/activity-log', 'ActivityLogController')->only('index', 'show');

        // Role
        Route::resource('/role', 'RoleController');

        // Permission Group
        Route::resource('/permission-group', 'PermissionGroupController');
        Route::post('/create-permission', 'PermissionGroupController@createPermission');
        Route::post('/edit-permission', 'PermissionGroupController@editPermission');
        Route::delete('/delete-permission', 'PermissionGroupController@deletePermission');

        // Permission
        // Route::resource('/permission', 'PermissionController');
});
