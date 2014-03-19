<?php
/**
 * Created by PhpStorm.
 * User: mini
 * Date: 13-12-30
 * Time: 下午2:24
 */

class Article extends Eloquent
{
    public static $upload_rules = array(
        'title'=>'required|max:200',
        'uploadImage' => 'required|mimes:jpeg,gif,png|max:3000',
        'uplaodType'=>'required|integer'
    );

    public static $uploadpath = 'upload/';
    public static $thumbpath = 'thumbnail/';
    public static $screenshotpath = 'screenshot/';

    protected $fillable = array('title', 'imgpath', 'thumbpath', 'user_id', 'type', 'gif');

    protected $softDelete = true;
    /**
     * one article has many comments
     * @return mixed
     */
    public function comments()
    {
        return $this->hasMany('Comment');
    }

    public function votes()
    {
        return $this->hasMany('Vote');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function getRecommend()
    {
        $rarticles = Article::orderBy('comments', 'desc')
                            ->skip(0)
                            ->take(10)
                            ->get();

        return $rarticles;
    }

    /**
     * get articles using clicks
     * @param $offset
     * @param $rownum
     * @return mixed
     */
    public function getHot($offset,$rownum)
    {
        if(Auth::check())
        {
            $articles = Article::leftJoin('votes', function($join)
            {
                $join->on('articles.id', '=', 'votes.article_id')
                    ->where('votes.user_id', '=', Auth::user()->id);
            })
                ->orderBy('articles.clicks', 'desc')
                ->skip($offset)
                ->take($rownum)
                ->select('articles.id','articles.title','articles.gif','articles.imgpath','articles.screenshot','articles.points','articles.comments','votes.state')
                ->cacheTags(array('article'))->remember(60)
                ->get();
        }
        else
        {
            $articles = Article::orderBy('points', 'desc')
                ->skip($offset)
                ->take($rownum)
                ->cacheTags(array('article'))->remember(60)
                ->get();
        }

        return $articles;
    }

    public function getLatest($offset,$rownum)
    {
        if(Auth::check())
        {
            $articles = Article::leftJoin('votes', function($join)
            {
                $join->on('articles.id', '=', 'votes.article_id')
                    ->where('votes.user_id', '=', Auth::user()->id);
            })
                ->orderBy('articles.created_at', 'desc')
                ->skip($offset)
                ->take($rownum)
                ->select('articles.id','articles.title','articles.gif','articles.imgpath','articles.screenshot','articles.points','articles.comments','votes.state')
                ->cacheTags(array('home','latest'))->remember(60)
                ->get();
        }
        else
        {
            $articles = Article::orderBy('created_at', 'desc')
                ->skip($offset)
                ->take($rownum)
                ->cacheTags(array('article'))->remember(60)
                ->get();
        }

        return $articles;
    }

    public function getGif($offset,$rownum)
    {
        if(Auth::check())
        {
            $articles = Article::leftJoin('votes', function($join){
                    $join->on('articles.id', '=', 'votes.article_id')
                        ->where('votes.user_id', '=', Auth::user()->id);
                })
            ->where('articles.gif','=',1)
                ->orderBy('articles.created_at', 'desc')
                ->skip($offset)
                ->take($rownum)
                ->select('articles.id','articles.title','articles.gif','articles.imgpath','articles.screenshot','articles.points','articles.comments','votes.state')
                ->cacheTags(array('article'))->remember(60)
                ->get();
        }
        else
        {
            $articles = Article::where('gif','=',1)
                ->orderBy('created_at', 'desc')
                ->skip($offset)
                ->take($rownum)
                ->cacheTags(array('article'))->remember(60)
                ->get();
        }

        return $articles;
    }

    public function getArticleByType($offset,$rownum,$type)
    {
        if(Auth::check())
        {
            $articles = Article::leftJoin('votes', function($join){
                    $join->on('articles.id', '=', 'votes.article_id')
                        ->where('votes.user_id', '=', Auth::user()->id);
                })
                ->where('articles.type','=',$type)
                ->orderBy('articles.created_at', 'desc')
                ->skip($offset)
                ->take($rownum)
                ->select('articles.id','articles.title','articles.gif','articles.imgpath','articles.screenshot','articles.points','articles.comments','votes.state')
                ->cacheTags(array('article'))->remember(60)
                ->get();
        }
        else
        {
            $articles = Article::where('type','=',$type)
                ->orderBy('created_at', 'desc')
                ->skip($offset)
                ->take($rownum)
                ->cacheTags(array('article'))->remember(60)
                ->get();
        }

        return $articles;
    }
}