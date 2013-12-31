<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/',  'HomeController@showHome');

Route::post('user/doLogin', 'UserController@doLogin');

Route::any('user/logout', 'UserController@logout');

Route::get('user/setting', function(){
    return View::make('user.setting.basic');
});

Route::get('user/setting/icon', function(){
    return View::make('user.setting.icon');
});

Route::get('user/setting/security', function(){
    return View::make('user.setting.security');
});

Route::get('user/register', function()
{
    return View::make('register.register');
});

Route::post('user/doRegister', 'UserController@doRegister');

Route::any('user/uploadIcon', 'UserController@uploadIcon');
