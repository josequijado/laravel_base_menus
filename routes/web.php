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

Route::get('/', 'MainController@index')
    ->name('index');

Route::get('change-language/{locale}', 'MainController@changeLanguage')
    ->name('chlg');

Route::get('change-theme/{theme}', 'MainController@changeTheme')
    ->name('chth');

// Grupo de rutas de autenticación
Route::group([], function () {
    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')
        ->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')
        ->name('logout');
    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')
        ->name('register');
    Route::post('register', 'Auth\RegisterController@register');
    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')
        ->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')
        ->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
        ->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')
        ->name('password.update');
    // Email Verification Routes...
    Route::get('email/verify', 'Auth\VerificationController@show')
        ->name('verification.notice');
    Route::get('email/verify/{id}', 'Auth\VerificationController@verify')
        ->name('verification.verify');
    Route::get('email/resend', 'Auth\VerificationController@resend')
        ->name('verification.resend');
});

// Rutas del master
Route::middleware(config('register.middlesMaster'))
    ->namespace('Master')
    ->prefix('master')
    ->name('master.')
    ->group(function(){
    Route::get('/index', 'MainController@index')
        ->name('index');
    Route::get('/m26', 'MainController@m26')
        ->middleware('check_option')
        ->name('page_m26');
    Route::get('/m27', 'MainController@m27')
        ->middleware('check_option')
        ->name('page_m27');
    Route::get('/m33', 'MainController@m33')
        ->middleware('check_option')
        ->name('page_m33');
    Route::get('/m34', 'MainController@m34')
        ->middleware('check_option')
        ->name('page_m34');
});

// Rutas del admin
Route::middleware(config('register.middlesAdmin'))
    ->namespace('Admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function(){
    Route::get('/index', 'MainController@index')
        ->name('index');
});

// Rutas del usuario
Route::middleware(config('register.middlesUser'))
    ->namespace('User')
    ->prefix('user')
    ->name('user.')
    ->group(function(){
    Route::get('/index', 'MainController@index')
        ->name('index');
});

