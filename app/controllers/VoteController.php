<?php

/**
 * Created by Kimhwawoon.
 * kimhwawoon@gmail.com
 * Date: 13-12-25
 */

class VoteController extends BaseController
{
	/**
     * like + 1
     * @return mixed
     */
    public function articleLike()
    {
		$articleid = Input::get("id");
        $article = Article::find($articleid);

        //first, delete
		$lastVote = Vote::where('user_id',Auth::user()->id)
                        ->where('article_id',$articleid)
                        ->first();

        $increase = 1;
        if(empty($lastVote))
        {
            //log user like record
            $vote = new Vote;
            $vote->user()->associate(Auth::user());
            $vote->article()->associate($article);
            $vote->state = 1;
            $vote->save();
        }
        else if($lastVote->state == -1)
        {
            $increase = 2;
            $lastVote->update(array('state' => 1));;
        }
        else
        {
            $increase = 0;
        }

        $article->increment('points',$increase);

        return Response::json(array(
        	'id' => $articleid,
        	'score' => $increase,
       	),200);
    }

    /**
     * cancel user up down select
     * @return mixed
     */
    public function articleUnlike()
    {
        $articleid = Input::get("id");
        $article = Article::find($articleid);

        //first delete
        $vote = Vote::where('user_id',Auth::user()->id)
                    ->where('article_id',$articleid)->first();

        $article->increment('points', -($vote->state) );

        $vote->delete();

        return Response::json(array(
            'id' => $articleid
        ),200);

    }

    /**
     * like - 1
     * @return mixed
     */
    public function articleDislike()
    {
        $articleid = Input::get("id");
        $article = Article::find($articleid);

        //first, delete
        $lastVote = Vote::where('user_id',Auth::user()->id)
                        ->where('article_id',$articleid)
                        ->first();

        $increase = -1;
        if(empty($lastVote))
        {
            //log user like record
            $vote = new Vote;
            $vote->user()->associate(Auth::user());
            $vote->article()->associate($article);
            $vote->state = -1;
            $vote->save();
        }
        else if($lastVote->state == 1)
        {
            echo 123;
            $increase = -2;
            $lastVote->update(array('state' => -1));;
        }
        else
        {
            $increase = 0;
        }

        $article->increment('points',$increase);

        return Response::json(array(
            'id' => $articleid,
            'score' => $increase,
        ),200);
    }
}