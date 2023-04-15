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

        // Category
        Route::resource('/category', 'CategoryController');
        Route::post('/category/{id}/restore', 'CategoryController@restore')->name('category.restore');
        Route::delete('/category/{id}/force-delete', 'CategoryController@forceDelete')->name('category.force-delete');

        // User
        Route::resource('/user', 'UserController');
        Route::get('/user/{user}/change-password', 'UserController@changePassword')->name('user.change-password');
        Route::patch('/user/{user}/update-password', 'UserController@updatePassword')->name('user.update-password');

        //Admin User
        Route::resource('/admin-user', 'AdminUserController');

        //Slider
        Route::resource('/slider', 'SliderController');
        Route::post('/slider/{id}/restore', 'SliderController@restore')->name('slider.restore');
        Route::delete('/slider/{id}/force-delete', 'SliderController@forceDelete')->name('slider.force-delete');

        //Blog
        Route::resource('/blog', 'BlogController');
        Route::post('/blog/{id}/restore', 'BlogController@restore')->name('blog.restore');
        Route::delete('/blog/{id}/force-delete', 'BlogController@forceDelete')->name('blog.force-delete');

        // Activity Log
        Route::resource('/activity-log', 'ActivityLogController')->only('index', 'show');

        // Role
        Route::resource('/role', 'RoleController');
        Route::get('/give-permission-to-role-form/{role}', 'RoleController@givePermissionToRoleForm')->name('give-permission-to-role-form');
        Route::post('/give-permission-to-role/{role}', 'RoleController@givePermissionToRole')->name('give-permission-to-role');

        // Permission Group
        Route::resource('/permission-group', 'PermissionGroupController');
        Route::post('/create-permission', 'PermissionGroupController@createPermission');
        Route::post('/edit-permission', 'PermissionGroupController@editPermission');
        Route::delete('/delete-permission', 'PermissionGroupController@deletePermission');

        // Permission
        // Route::resource('/permission', 'PermissionController');
});
