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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@index')->name('admin.home');
    Route::get('login', 'AdminAuth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'AdminAuth\LoginController@login');
    Route::get('logout', 'AdminAuth\LoginController@logout');
    Route::get('password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('password/reset', 'AdminAuth\ResetPasswordController@reset')->name('admin.password.update');
});
