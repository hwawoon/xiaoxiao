<?php

/**
 * Created by Kimhwawoon.
 * kimhwawoon@gmail.com
 * Date: 13-12-25
 */

class HomeController extends BaseController
{
    private $pageRow = 10;
     /**
     * 获取热门
     * @return mixed
     */
    public function showHome()
	{
        $lobjArticle = new Article();
        $articles = $lobjArticle->getHot(0,$this->pageRow);

        //if hot is null return latest
        if($articles->isEmpty())
        {
            $articles = $lobjArticle->getLatest(0,$this->pageRow);
        }

        return View::make('/home')->with('pageinfo','home')
                                   ->with('getmore',"moreHot")
                                   ->with('articles',$articles)
                                   ->with('num',$this->pageRow);
    }

    public function moreHot()
    {
        $articleOffset = Input::get('offset');

        $lobjArticle = new Article();
        $articles = $lobjArticle->getHot($articleOffset,$this->pageRow);

        if($articles->isEmpty())
        {
            $articles = $lobjArticle->getLatest($articleOffset,$this->pageRow);
        }

        $loadPage = View::make('includes.article-section')->with('articles',$articles)->render();

        return Response::json(array(
            'rows'=> $loadPage,
            'count'=> count($articles)
        ) , 200 );

    }

    /**
     * 获取新鲜
     * @return mixed
     */
    public function showLatest()
    {
        $lobjArticle = new Article();
        $articles = $lobjArticle->getLatest(0,$this->pageRow);

        return View::make('/home')->with('pageinfo','latest')
                                  ->with('getmore',"moreLatest")
                                  ->with('articles',$articles)
                                  ->with('num',$this->pageRow);
    }

    public function moreLatest()
    {
        $articleOffset = Input::get('offset');

        $lobjArticle = new Article();
        $articles = $lobjArticle->getLatest($articleOffset,$this->pageRow);

        $loadPage = View::make('includes.article-section')->with('articles',$articles)->render();

        return Response::json(array(
            'rows'=> $loadPage,
            'count'=> count($articles)
        ) , 200 );
    }

    public function showNeihan()
    {
        $this->pageRow = 10;

        $lobjArticle = new Article();
        $articles = $lobjArticle->getArticleByType(0,$this->pageRow,5);

        return View::make('/home')->with('pageinfo','cute')
                                ->with('getmore',"moreCute")
                                ->with('articles',$articles)
                                ->with('num',$this->pageRow);
    }

    public function moreNeihan()
    {
        $articleOffset = Input::get('offset');

        $lobjArticle = new Article();
        $articles = $lobjArticle->getArticleByType($articleOffset,$this->pageRow,5);

        $loadPage = View::make('includes.article-section')->with('articles',$articles)->render();

        return Response::json(array(
            'rows'=> $loadPage,
            'count'=> count($articles)
        ) , 200 );
    }

    public function showGif()
    {
        $lobjArticle = new Article();
        $articles = $lobjArticle->getGif(0,$this->pageRow);

        return View::make('/home')->with('pageinfo','gif')
                                    ->with('getmore',"moreGif")
                                    ->with('articles',$articles)
                                    ->with('num',$this->pageRow);
    }

    public function moreGif()
    {
        $articleOffset = Input::get('offset');

        $lobjArticle = new Article();
        $articles = $lobjArticle->getGif($articleOffset,$this->pageRow);

        $loadPage = View::make('includes.article-section')->with('articles',$articles)->render();

        return Response::json(array(
            'rows'=> $loadPage,
            'count'=> count($articles)
        ) , 200 );
    }

    public function showCute()
    {
        $this->pageRow = 10;

        $lobjArticle = new Article();
        $articles = $lobjArticle->getArticleByType(0,$this->pageRow,1);

        return View::make('/home')->with('pageinfo','cute')
                                ->with('getmore',"moreCute")
                                ->with('articles',$articles)
                                ->with('num',$this->pageRow);
    }

    public function moreCute()
    {
        $articleOffset = Input::get('offset');

        $lobjArticle = new Article();
        $articles = $lobjArticle->getArticleByType($articleOffset,$this->pageRow,1,1);

        $loadPage = View::make('includes.article-section')->with('articles',$articles)->render();

        return Response::json(array(
            'rows'=> $loadPage,
            'count'=> count($articles)
        ) , 200 );
    }

    public function showJiong()
    {
        $this->pageRow = 10;

        $lobjArticle = new Article();
        $articles = $lobjArticle->getArticleByType(0,$this->pageRow,2);

        return View::make('/home')->with('pageinfo','jiong')
                                    ->with('getmore',"moreJiong")
                                    ->with('articles',$articles)
                                    ->with('num',$this->pageRow);
    }

    public function moreJiong()
    {
        $articleOffset = Input::get('offset');

        $lobjArticle = new Article();
        $articles = $lobjArticle->getArticleByType($articleOffset,$this->pageRow,2);

        $loadPage = View::make('includes.article-section')->with('articles',$articles)->render();

        return Response::json(array(
            'rows'=> $loadPage,
            'count'=> count($articles)
        ) , 200 );
    }

    public function showBeauty()
    {
        $this->pageRow = 10;

        $lobjArticle = new Article();
        $articles = $lobjArticle->getArticleByType(0,$this->pageRow,3);

        return View::make('/home')->with('pageinfo','beauty')
                                    ->with('getmore',"moreBeauty")
                                    ->with('articles',$articles)
                                    ->with('num',$this->pageRow);
    }

    public function moreBeauty()
    {
        $articleOffset = Input::get('offset');

        $lobjArticle = new Article();
        $articles = $lobjArticle->getArticleByType($articleOffset,$this->pageRow,3);

        $loadPage = View::make('includes.article-section')->with('articles',$articles)->render();

        return Response::json(array(
            'rows'=> $loadPage,
            'count'=> count($articles)
        ) , 200 );
    }

    public function showTucao()
    {
        $this->pageRow = 10;

        $lobjArticle = new Article();
        $articles = $lobjArticle->getArticleByType(0,$this->pageRow,4);

        return View::make('/home')->with('pageinfo','tucao')
                                    ->with('getmore',"moreTucao")
                                    ->with('articles',$articles)
                                    ->with('num',$this->pageRow);
    }

    public function moreTucao()
    {
        $articleOffset = Input::get('offset');

        $lobjArticle = new Article();
        $articles = $lobjArticle->getArticleByType($articleOffset,$this->pageRow,4);

        $loadPage = View::make('includes.article-section')->with('articles',$articles)->render();

        return Response::json(array(
            'rows'=> $loadPage,
            'count'=> count($articles)
        ) , 200 );
    }

    public function showOther()
    {
        $this->pageRow = 10;

        $lobjArticle = new Article();
        $articles = $lobjArticle->getArticleByType(0,$this->pageRow,0);

        return View::make('/home')->with('pageinfo','other')
                                    ->with('getmore',"moreOther")
                                    ->with('articles',$articles)
                                    ->with('num',$this->pageRow);
    }

    public function moreOther()
    {
        $articleOffset = Input::get('offset');

        $lobjArticle = new Article();
        $articles = $lobjArticle->getArticleByType($articleOffset,$this->pageRow,0);

        $loadPage = View::make('includes.article-section')->with('articles',$articles)->render();

        return Response::json(array(
            'rows'=> $loadPage,
            'count'=> count($articles)
        ) , 200 );
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

        return View::make('/home')->with('pageinfo', "搜索 ".$searchTerm )
                                   ->with('getmore', '')
                                   ->with('articles',$articles)
                                   ->with('num', 0);
    }
}