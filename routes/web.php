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

Route::get('/forget-password', [App\Http\Controllers\Frontend\Auth\ForgetPasswordController::class, 'forgetPassword'])->name('forget-password');
Route::post('/forget-password/send-request', [App\Http\Controllers\Frontend\Auth\ForgetPasswordController::class, 'sendRequest'])->name('send-request');
Route::get('/forget-password/otp-for-new-password', [App\Http\Controllers\Frontend\Auth\ForgetPasswordController::class, 'otpForNewPassword'])->name('otp-for-new-password');
Route::post('/forget-password/new-password', [App\Http\Controllers\Frontend\Auth\ForgetPasswordController::class, 'newPassword'])->name('new-password');
Route::post('/forget-password/change-password', [App\Http\Controllers\Frontend\Auth\ForgetPasswordController::class, 'changePassword'])->name('change-password');

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
});
