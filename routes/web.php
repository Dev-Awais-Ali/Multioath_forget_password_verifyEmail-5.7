<?php

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


Route::group(['prefix'=>'dashboard','namespace'=>'Admin'],function(){
	// Authentication Routes...
    Route::get('/login','Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login','Auth\LoginController@login')->name('adminlogin');
    Route::post('/logout','Auth\LoginController@logout')->name('adminlogout');
    // End authentication routes

    // Admin Email verification routes
    Route::get('email/verify', 'Auth\VerificationController@show')->name('admin.verification.notice');
    Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('admin.verification.verify');
    Route::get('email/resend', 'Auth\VerificationController@resend')->name('admin.verification.resend');

    //admin password reset routes
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('admin.password.update');
    // End Admin Email verification routes
	Route::get('/','AdminController@index')->name('admin.home');
});
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
