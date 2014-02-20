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
        $getnum = 5;

        $articles = Article::orderBy('points', 'desc')
                           ->skip(0)->take($getnum)->get();

        // if(Auth::check())
        // {
        //     $votes = Article::with(array('votes' => function($query)
        //     {
        //         $query->where('user_id', '=', Auth::user()->id);
        //     }))->get();
        // }

        $rarticles = Article::orderBy('comments', 'desc')
                            ->skip(0)->take(10)->get();

        return View::make('/home')->with('pageinfo','home')
                                   ->with('getmore',"article/getMoreHot")
                                   ->with('articles',$articles)
                                   ->with('articlenum',$getnum)
                                   ->with('rarticles',$rarticles);
    }

    public function getMoreHotArticle()
    {
        $articleOffset = Input::get('articleOffset');

        $articles = DB::table('articles')->orderBy('up', 'desc')->skip($articleOffset)->take(10)->get();

        return Response::json($articles , 200 );
    }

    /**
     * 获取新鲜
     * @return mixed
     */
    public function showLatest()
    {
        $getnum = 10;

        $articles = DB::table('articles')->orderBy('created_at', 'desc')
            ->skip(0)->take($getnum)->get();

        $rarticles = $this->getRecommendArticle();

        return View::make('/home')->with('pageinfo','latest')
                                    ->with('getmore',"article/getMoreLatest")
                                    ->with('articles',$articles)
                                    ->with('articlenum',$getnum)
                                    ->with('rarticles',$rarticles);
    }

    public function getMoreLatestArticle()
    {
        $articleOffset = Input::get('articleOffset');

        $articles = DB::table('articles')->orderBy('created_at', 'desc')->skip($articleOffset)->take(10)->get();

        return Response::json($articles , 200 );
    }

    public function searchArticle()
    {
        $rarticles = $this->getRecommendArticle();

        $searchTerm = Input::get('srch-term');
        $articles = DB::table('articles')->where('title', 'like' , "%$searchTerm%" )
                                         ->orderBy('comments', 'desc')->get();



        return View::make('/search')->with('pagetitle',"搜索 ".$searchTerm )
                                      ->with('getmore',"")
                                      ->with('articles',$articles)
                                      ->with('articlenum',0)
                                      ->with('rarticles',$rarticles);
    }
}