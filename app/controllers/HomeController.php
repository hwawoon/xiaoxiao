<?php

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

        $articles = DB::table('articles')->orderBy('up', 'desc')
                                         ->skip(0)->take($getnum)->get();

        $rarticles = $this->getRecommendArticle();

        return View::make('/home')->with('pagetitle',"热门")
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
        $getnum = 5;

        $articles = DB::table('articles')->orderBy('created_at', 'desc')
            ->skip(0)->take($getnum)->get();

        $rarticles = $this->getRecommendArticle();

        return View::make('/home')->with('pagetitle',"新鲜")
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

    /**
     * 获取推荐列表，一获取20个
     * @return mixed
     */
    public function getRecommendArticle()
    {
        $articles = DB::table('articles')->orderBy('comments', 'desc')->skip(0)->take(20)->get();

        return $articles;
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