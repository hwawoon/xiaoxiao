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

Route::get('/register', function()
{
    return View::make('register');
});

Route::get('/aboutMe', function()
{
    return View::make('about');
});

Route::get('/latest',  'HomeController@showLatest');

Route::group(array('before' => 'csrf'), function()
{
    Route::post('user/doLogin', 'UserController@doLogin');

    Route::post('/register', 'UserController@doRegister');
});

Route::any('user/logout', 'UserController@logout');

Route::get('/nameChecker',  function(){
    $validator = Validator::make(
        array(
            'name' => Input::get('name')
        ),
        array(
            'name' => 'unique:users'
        )
    );
    if ($validator->fails())
    {
        return Response::json(false,200);
    }

    return Response::json(true,200);
});

Route::get('/emailChecker',  function(){
    $validator = Validator::make(
        array(
            'email' => Input::get('email')
        ),
        array(
            'email' => 'unique:users'
        )
    );
    if ($validator->fails())
    {
        return Response::json(false,200);
    }

    return Response::json(true,200);
});

Route::any('article/getMoreHot', 'HomeController@getMoreHotArticle');

Route::any('article/getMoreLatest', 'HomeController@getMoreLatestArticle');

Route::any('user/uploadIcon', 'UserController@uploadIcon');

Route::get("article/{id}", array(
    "as"=>"getArticle",
    "uses"=>"ArticleController@getArticle"
))->where('id', '[0-9]+');

Route::get('article/previous/{id}', 'ArticleController@previousArticle')->where('id', '[0-9]+');
Route::get('article/next/{id}', 'ArticleController@nextArticle')->where('id', '[0-9]+');

Route::get('article/search','HomeController@searchArticle');

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

    // forward to user update pwd page
    Route::get('user/setting/security', function()
    {
        return View::make('user.setting.security');
    });

    Route::get('user/setting/message','MessageController@getAllMessage');

    Route::post('article/uploadImage',  'ArticleController@uploadImageArticle');
    Route::post('article/forwardImage',  'ArticleController@forwardImageArticle');

    Route::post('comment/addComment/{userid}/{articleid}', 'CommentController@addComment')
        ->where(array('userid' => '[0-9]+', 'articleid' => '[0-9]+'));

    Route::get('article/articlePointUp',  'ArticleController@articlePointUp');
    Route::get('article/articlePointDown',  'ArticleController@articlePointDown');

    Route::get('user/profile', 'UserController@getUserProfile');

    Route::post('user/saveUserBasicInfo', 'UserController@saveUserBasicInfo');

    Route::post('user/uploadSourceImage', 'UserController@uploadSourceImage');

    Route::post('user/saveUserIcon', 'UserController@saveUserIcon');

    //update user password
    Route::post('user/updatePassword', 'UserController@updatePassword');

    Route::get('msg/getMessage', 'MessageController@getMessage');

    Route::post('article/deleteArticle', 'ArticleController@deleteArticle');

});

//reset password
Route::get('/user/reset',  'RemindersController@getRemind');

Route::post('/user/postRemind',  'RemindersController@postRemind');

Route::post('/user/postReset','RemindersController@postReset');

Route::get('password/reset/{token}', array(
    'uses' => 'RemindersController@getReset',
    'as' => 'password.reset'
));