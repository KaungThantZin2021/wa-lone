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

// Route::get('/', function () {
//     return view('frontend.home');
// });

Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
Route::get('/register', [App\Http\Controllers\Frontend\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Frontend\Auth\RegisterController::class, 'register'])->name('register');

Route::get('/login', [App\Http\Controllers\Frontend\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Frontend\Auth\LoginController::class, 'login'])->name('login');
Route::post('/logout', [App\Http\Controllers\Frontend\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/forget-password', [App\Http\Controllers\Frontend\Auth\ForgetPasswordController::class, 'showForgetPasswordForm'])->name('forget-password');
Route::post('/forget-password', [App\Http\Controllers\Frontend\Auth\ForgetPasswordController::class, 'submitForgetPasswordForm'])->name('forget-password.store');
Route::get('/reset-password/{token}', [App\Http\Controllers\Frontend\Auth\ForgetPasswordController::class, 'showResetPasswordForm'])->name('reset-password');
Route::post('/reset-password', [App\Http\Controllers\Frontend\Auth\ForgetPasswordController::class, 'submitResetPasswordForm'])->name('reset-password.store');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::namespace('App\Http\Controllers\Frontend')
->group(function () {
    Route::namespace('Auth')
    ->group(function () {
        Route::get('/auth/{provider}/redirect', 'SocialiteController@provider');
        Route::get('/auth/{provider}/callback', 'SocialiteController@callback');
    });

    Route::post('/change-language', 'PageController@changeLanguage');

    Route::get('/blogs', 'BlogController@index')->name('blogs');
    Route::get('/blog/{blog}', 'BlogController@show')->name('blog.show');

    Route::get('/profile', 'HomeController@profile')->name('profile');

    Route::post('/notifications/subscribe', 'NotificationController@subscribe');
    Route::post('/notifications/unsubscribe', 'NotificationController@unsubscribe');

    Route::get('/notifications', 'NotificationController@index')->name('notifications');
    Route::get('/notification/{id}', 'NotificationController@show')->name('notification.show');
});
