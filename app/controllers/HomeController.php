<?php

/**
 * Created by Kimhwawoon.
 * kimhwawoon@gmail.com
 * Date: 13-12-25
 */

class HomeController extends BaseController
{
     /**
     * 获取热门
     * @return mixed
     */
    public function showHome()
	{
        $getnum = 10;

        $lobjArticle = new Article();
        $articles = $lobjArticle->getHot(0,$getnum);

        return View::make('/home')->with('pageinfo','home')
                                    ->with('getmore',"moreHot")
                                    ->with('articles',$articles)
                                    ->with('articlenum',$getnum);
    }

    public function moreHot()
    {
        $articleOffset = Input::get('articleOffset');

        $lobjArticle = new Article();
        $articles = $lobjArticle->getHot($articleOffset,10);

        return Response::json($articles , 200 );
    }

    /**
     * 获取新鲜
     * @return mixed
     */
    public function showLatest()
    {
        $getnum = 10;

        $lobjArticle = new Article();
        $articles = $lobjArticle->getLatest(0,$getnum);

        return View::make('/home')->with('pageinfo','latest')
                                  ->with('getmore',"moreLatest")
                                  ->with('articles',$articles)
                                  ->with('articlenum',$getnum);
    }

    public function moreLatest()
    {
        $articleOffset = Input::get('articleOffset');

        $lobjArticle = new Article();
        $articles = $lobjArticle->getLatest($articleOffset,10);

        return Response::json($articles , 200 );
    }

    public function showGif()
    {
        $getnum = 10;

        $lobjArticle = new Article();
        $articles = $lobjArticle->getGif(0,$getnum);

        return View::make('/home')->with('pageinfo','gif')
                                    ->with('getmore',"moreGif")
                                    ->with('articles',$articles)
                                    ->with('articlenum',$getnum);
    }

    public function moreGif()
    {
        $articleOffset = Input::get('articleOffset');

        $lobjArticle = new Article();
        $articles = $lobjArticle->getGif($articleOffset,10);

        return Response::json($articles , 200 );
    }

    public function showCute()
    {
        $getnum = 10;

        $lobjArticle = new Article();
        $articles = $lobjArticle->getArticleByType(0,$getnum,1);

        return View::make('/home')->with('pageinfo','cute')
                                ->with('getmore',"moreCute")
                                ->with('articles',$articles)
                                ->with('articlenum',$getnum);
    }

    public function moreCute()
    {
        $articleOffset = Input::get('articleOffset');

        $lobjArticle = new Article();
        $articles = $lobjArticle->getArticleByType($articleOffset,10,1);

        return Response::json($articles , 200 );
    }

    public function showJiong()
    {
        $getnum = 10;

        $lobjArticle = new Article();
        $articles = $lobjArticle->getArticleByType(0,$getnum,2);

        return View::make('/home')->with('pageinfo','jiong')
                                    ->with('getmore',"moreJiong")
                                    ->with('articles',$articles)
                                    ->with('articlenum',$getnum);
    }

    public function moreJiong()
    {
        $articleOffset = Input::get('articleOffset');

        $lobjArticle = new Article();
        $articles = $lobjArticle->getArticleByType($articleOffset,10,2);

        return Response::json($articles , 200 );
    }

    public function showBeauty()
    {
        $getnum = 10;

        $lobjArticle = new Article();
        $articles = $lobjArticle->getArticleByType(0,$getnum,3);

        return View::make('/home')->with('pageinfo','beauty')
                                    ->with('getmore',"moreBeauty")
                                    ->with('articles',$articles)
                                    ->with('articlenum',$getnum);
    }

    public function moreBeauty()
    {
        $articleOffset = Input::get('articleOffset');

        $lobjArticle = new Article();
        $articles = $lobjArticle->getArticleByType($articleOffset,10,3);

        return Response::json($articles , 200 );
    }

    public function showTucao()
    {
        $getnum = 10;

        $lobjArticle = new Article();
        $articles = $lobjArticle->getArticleByType(0,$getnum,4);

        return View::make('/home')->with('pageinfo','tucao')
                                    ->with('getmore',"moreTucao")
                                    ->with('articles',$articles)
                                    ->with('articlenum',$getnum);
    }

    public function moreTucao()
    {
        $articleOffset = Input::get('articleOffset');

        $lobjArticle = new Article();
        $articles = $lobjArticle->getArticleByType($articleOffset,10,4);

        return Response::json($articles , 200 );
    }

    public function showOther()
    {
        $getnum = 10;

        $lobjArticle = new Article();
        $articles = $lobjArticle->getArticleByType(0,$getnum,0);

        return View::make('/home')->with('pageinfo','other')
                                    ->with('getmore',"moreOther")
                                    ->with('articles',$articles)
                                    ->with('articlenum',$getnum);
    }

    public function moreOther()
    {
        $articleOffset = Input::get('articleOffset');

        $lobjArticle = new Article();
        $articles = $lobjArticle->getArticleByType($articleOffset,10,0);

        return Response::json($articles , 200 );
    }

    public function searchArticle()
    {
        $searchTerm = Input::get('srch-term');

        if(Auth::check())
        {
            $articles = Article::leftJoin('votes', function($join)
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