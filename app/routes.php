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

Route::get('user/register', function()
{
    return View::make('register.register');
});

Route::post('user/doRegister', 'UserController@doRegister');

//个人设置
Route::get('user/setting', array('before' => 'guest', function()
{
    return View::make('user.setting.basic');
}));

Route::get('user/setting/icon', array('before' => 'guest', function()
{
    return View::make('user.setting.icon');
}));

Route::any('user/uploadIcon', 'UserController@uploadIcon');

Route::get('user/setting/security', array('before' => 'guest', function()
{
    return View::make('user.setting.security');
}));