<?php

/**
 * Created by Kimhwawoon.
 * kimhwawoon@gmail.com
 * Date: 13-12-25
 */

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

    /**
     * 获取热门
     * @return mixed
     */
    public function showHome()
	  {
        $getnum = 10;

        if(Auth::check())
        {
            $articles = DB::table('articles')
                ->leftJoin('votes', function($join)
                {
                    $join->on('articles.id', '=', 'votes.article_id')
                        ->where('votes.user_id', '=', Auth::user()->id);
                })
                ->orderBy('articles.points', 'desc')
                ->skip(0)
                ->take($getnum)
                ->select('articles.id','articles.title','articles.imgpath','articles.points','articles.comments','votes.state')
                ->get();
        }
        else
        {
            $articles = Article::orderBy('points', 'desc')
                ->skip(0)
                ->take($getnum)
                ->get();
        }

        $rarticles = Article::orderBy('comments', 'desc')
                            ->skip(0)
                            ->take(10)
                            ->get();

        return View::make('/home')->with('pageinfo','home')
                                  ->with('getmore',"getMoreHot")
                                  ->with('articles',$articles)
                                  ->with('articlenum',$getnum)
                                  ->with('rarticles',$rarticles);
    }

    public function getMoreHotArticle()
    {
        $articleOffset = Input::get('articleOffset');

        if(Auth::check())
        {
            $articles = DB::table('articles')
                          ->leftJoin('votes', function($join)
                          {
                              $join->on('articles.id', '=', 'votes.article_id')
                                   ->where('votes.user_id', '=', Auth::user()->id);
                          })
                          ->orderBy('articles.points', 'desc')
                          ->skip($articleOffset)
                          ->take(10)
                          ->select('articles.id','articles.title','articles.imgpath','articles.points','articles.comments','votes.state')
                          ->get();
        }
        else
        {
            $articles = Article::orderBy('points', 'desc')
                               ->skip($articleOffset)
                               ->take(10)
                               ->get();
        }

        return Response::json($articles , 200 );
    }

    /**
     * 获取新鲜
     * @return mixed
     */
    public function showLatest()
    {
        $getnum = 10;

        if(Auth::check())
        {
            $articles = DB::table('articles')
                ->leftJoin('votes', function($join)
                {
                    $join->on('articles.id', '=', 'votes.article_id')
                        ->where('votes.user_id', '=', Auth::user()->id);
                })
                ->orderBy('articles.created_at', 'desc')
                ->skip(0)
                ->take($getnum)
                ->select('articles.id','articles.title','articles.imgpath','articles.points','articles.comments','votes.state')
                ->get();
        }
        else
        {
            $articles = Article::orderBy('created_at', 'desc')
                ->skip(0)
                ->take($getnum)
                ->get();
        }

        $rarticles = Article::orderBy('comments', 'desc')
                            ->skip(0)
                            ->take(10)
                            ->get();

        return View::make('/home')->with('pageinfo','latest')
                                  ->with('getmore',"getMoreLatest")
                                  ->with('articles',$articles)
                                  ->with('articlenum',$getnum)
                                  ->with('rarticles',$rarticles);
    }

    public function getMoreLatestArticle()
    {
        $articleOffset = Input::get('articleOffset');

        if(Auth::check())
        {
            $articles = DB::table('articles')
                          ->leftJoin('votes', function($join)
                          {
                              $join->on('articles.id', '=', 'votes.article_id')
                                   ->where('votes.user_id', '=', Auth::user()->id);
                          })
                          ->orderBy('articles.created_at', 'desc')
                          ->skip($articleOffset)
                          ->take(10)
                          ->select('articles.id','articles.title','articles.imgpath','articles.points','articles.comments','votes.state')
                          ->get();
        }
        else
        {
            $articles = Article::orderBy('created_at', 'desc')
                               ->skip($articleOffset)
                               ->take(10)
                               ->get();
        }

        return Response::json($articles , 200 );
    }

    public function searchArticle()
    {

        $searchTerm = Input::get('srch-term');

        if(Auth::check())
        {
            $articles = DB::table('articles')
                          ->leftJoin('votes', function($join)
                          {
                              $join->on('articles.id', '=', 'votes.article_id')
                                   ->where('votes.user_id', '=', Auth::user()->id);
                          })
                          ->where('title', 'like' , "%$searchTerm%" )
                          ->orderBy('articles.points', 'desc')
                          ->skip(0)
                          ->take(10)
                          ->select('articles.id','articles.title','articles.imgpath','articles.points','articles.comments','votes.state')
                          ->get();
        }
        else
        {
            $articles = Article::where('title', 'like' , "%$searchTerm%" )
                               ->orderBy('points', 'desc')
                               ->skip(0)
                               ->take(10)
                               ->get();
        }

        $rarticles = Article::orderBy('comments', 'desc')
                            ->skip(0)
                            ->take(10)
                            ->get();

        return View::make('/home')->with('pageinfo', "搜索 ".$searchTerm )
                                  ->with('getmore', '')
                                  ->with('articles',$articles)
                                  ->with('articlenum', 0)
                                  ->with('rarticles',$rarticles);
    }
}