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

Route::any('moreHot', 'HomeController@moreHot');

Route::get('/latest',  'HomeController@showLatest');

Route::any('moreLatest', 'HomeController@moreLatest');

Route::get('/gif',  'HomeController@showGif');

Route::any('moreGif', 'HomeController@moreGif');

Route::get('/cute',  'HomeController@showCute');

Route::any('moreCute', 'HomeController@moreCute');

Route::get('/jiong',  'HomeController@showJiong');

Route::any('moreJiong', 'HomeController@moreJiong');

Route::get('/beauty',  'HomeController@showBeauty');

Route::any('moreBeauty', 'HomeController@moreBeauty');

Route::get('/tucao',  'HomeController@showTucao');

Route::any('moreTucao', 'HomeController@moreTucao');

Route::get('/other', 'HomeController@showOther');

Route::any('moreOther', 'HomeController@moreOther');

Route::get('/aboutMe', function()
{
    return View::make('about');
});

Route::get('/register', function()
{
    return View::make('register');
});



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

Route::any('getMoreHot', 'HomeController@getMoreHotArticle');

Route::any('getMoreLatest', 'HomeController@getMoreLatestArticle');

Route::get('comment/all', 'CommentController@getIndexByArt');

Route::any('user/uploadIcon', 'UserController@uploadIcon');

Route::get("art/{id}", array(
    "as"=>"getArticle",
    "uses"=>"ArticleController@getArticle"
))->where('id', '[0-9]+');

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

    Route::post('uploadImage',  'ArticleController@uploadImageArticle');
    Route::post('article/forwardImage',  'ArticleController@forwardImageArticle');

    //add comment
    Route::post('comment/add', 'CommentController@addComment');

    Route::post('comment/up', 'CommentController@upComment');

    Route::post('comment/delete', 'CommentController@destroy');

    Route::get('vote/like',  'VoteController@articleLike');
    Route::get('vote/unlike',  'VoteController@articleUnlike');
    Route::get('vote/dislike',  'VoteController@articleDislike');

    Route::post('user/basic/save', 'UserController@saveUserBasicInfo');

    Route::post('user/avatar/upload', 'UserController@uploadSourceImage');

    Route::post('user/avatar/save', 'UserController@saveUserIcon');
    //update user password
    Route::post('user/password/update', 'UserController@updatePassword');

    Route::post('art/delete', 'ArticleController@destroy');

    //message controller
    Route::get('user/message','MessageController@getAllMessage');

    Route::get('msg/ignore','MessageController@ingnoreMessages');

    Route::get('message/notify', 'MessageController@getMessage');

});

//everybody can see anyone profile
Route::get('user/profile/{name}', 'UserController@getUserProfile');

Route::get('user/comment/{name}', 'UserController@getUserCommentArticle');

Route::get('user/vote/{name}', 'UserController@getUserVoteArticle');

//reset password
Route::get('/user/reset',  'RemindersController@getRemind');

Route::post('/user/postRemind',  'RemindersController@postRemind');

Route::post('/user/postReset','RemindersController@postReset');

Route::get('password/reset/{token}', array(
    'uses' => 'RemindersController@getReset',
    'as' => 'password.reset'
));

Route::group(array('prefix' => 'admin', 'before' => 'auth.admin'), function()
{
    Route::get('/', 'AdminController@index');

    Route::get('/users', 'AdminController@getUserList');

    Route::get('/articles', 'AdminController@getArticleList');
});