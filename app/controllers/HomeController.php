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

	public function showHome()
	{
        $getnum = 5;

        $articles = DB::table('articles')->orderBy('up', 'desc')
                                         ->skip(0)->take($getnum)->get();

        $rarticles = $this->getRecommendArticle();

        return View::make('/home')->with('articles',$articles)
                                    ->with('articlenum',$getnum)
                                    ->with('rarticles',$rarticles);
    }

    public function getMoreHotArticle()
    {
        $articleOffset = Input::get('articleOffset');

        $articles = DB::table('articles')->orderBy('up', 'desc')->skip($articleOffset)->take(10)->get();

        return Response::json($articles , 200 );
    }

    public function getRecommendArticle()
    {
        $articles = DB::table('articles')->orderBy('comments', 'desc')->skip(0)->take(20)->get();

        return $articles;
    }

    public function getMoreNewArticle()
    {
        $articleOffset = Input::get('articleOffset');

        $articles = DB::table('articles')->orderBy('up', 'desc')->skip($articleOffset)->take(10)->get();

        return Response::json($articles , 200 );
    }
}