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

Route::get('/latest',  'HomeController@showLatest');

Route::post('user/doLogin', 'UserController@doLogin');

Route::any('user/logout', 'UserController@logout');

Route::get('user/register', function()
{
    return View::make('register.register');
});

Route::any('article/getmorehot', 'HomeController@getMoreHotArticle');

Route::any('article/getmorelatest', 'HomeController@getMoreLatestArticle');

Route::post('user/doRegister', 'UserController@doRegister');

Route::any('user/uploadIcon', 'UserController@uploadIcon');

Route::get('article/{id}', 'ArticleController@getArticle')->where('id', '[0-9]+');

Route::group(array('before' => 'auth'), function()
{
    //个人设置
    Route::get('user/setting', function()
    {
        return View::make('user.setting.basic');
    });

    Route::get('user/setting/icon', function()
    {
        return View::make('user.setting.icon');
    });

    Route::get('user/setting/security', function()
    {
        return View::make('user.setting.security');
    });

    Route::post('article/uploadImage',  'ArticleController@uploadImageArticle');
    Route::post('article/forwardImage',  'ArticleController@forwardImageArticle');

    Route::post('comment/addComment/{userid}/{articleid}', 'CommentController@addComment')
        ->where(array('userid' => '[0-9]+', 'articleid' => '[0-9]+'));
});

Route::get('article/articlePointUp',  'ArticleController@articlePointUp');
Route::get('article/articlePointDown',  'ArticleController@articlePointDown');