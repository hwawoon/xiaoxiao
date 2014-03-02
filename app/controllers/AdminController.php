<?php
/**
 * Created by PhpStorm.
 * User: kimi
 * Date: 14-3-2
 * Time: 下午6:37
 */

class adminController extends BaseController
{
    public function index()
    {
        return View::make('admin.index');
    }

    public function getUserList()
    {
        $users = User::orderBy('id')->paginate(20);
        return View::make('admin.users')->with('users',$users);
    }

        public function getArticleList()
    {
        $articles = Article::orderBy('created_at','desc')->paginate(10);

        return View::make('admin.articles')->with('articles',$articles);
    }
} 