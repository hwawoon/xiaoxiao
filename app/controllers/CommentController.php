<?php

/**
 * Created by Kimhwawoon.
 * kimhwawoon@gmail.com
 * Date: 13-12-25
 */

class CommentController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		$comment_id = Input::get('id');
		Comment::find($comment_id)->delete();

		return Response::json(array(
        	'state'=> 1
        ) , 200 );
	}

    /**
     * add comments
     * @param $userid
     * @param $articleid
     * @return mixed
     */
    public function addComment()
    {
    	$datas = array(
    		'article_id' => Input::get('articleId'),
    		'article_author' => Input::get('articleAuthor'),
    		'comment_id' => Input::get('comment_id'),
    		'content' => Input::get('myComment'),
		);

    	//validateForm
    	$validator = Validator::make($datas,
		array(
			'article_id' => 'required|numeric',
    		'article_author' => 'required|numeric',
    		'comment_id' => 'required|numeric',
    		'content' => 'required|max:200',
		));

        if($validator->fails())
        {
            return Response::json(array('state' => 0),200);
        }

    	$article = Article::find($datas['article_id']);

        $loComment = new Comment();
        $loComment->content = $datas['content'];
        $loComment->article()->associate($article);
        $loComment->comment_id = $datas['comment_id'];
        $loComment->receiver = $datas['article_author'];
        $loComment->user()->associate(Auth::user());
        $loComment->save();

        $article->increment('comments',1);

        //send message to Author
        if($datas['article_author'] != Auth::user()->id)
        {
	        $loMessage = new Message();
	        $loMessage->article()->associate($article);
	        $loMessage->sender()->associate(Auth::user());
	        $loMessage->receiver_id = $datas['article_author'];
	        $loMessage->save();

	        User::find($datas['article_author'])->increment('messages',1);
	    }
        //if comment reply send message to parent comment author
        if(!empty($datas['comment_id']))
        {
        	$prtCmtUser = Comment::find($datas['comment_id'])->user()->first();
        	if($prtCmtUser->id != Auth::user()->id)
        	{
        		$cMessage = new Message();
	        	$cMessage->article()->associate($article);
		        $cMessage->sender()->associate(Auth::user());
		        $cMessage->receiver()->associate($prtCmtUser);
		        $cMessage->comment()->associate($loComment);
		        $cMessage->save();

		        $prtCmtUser->increment('messages',1);
        	}
        }

        //forget cache
        Cache::forget('comment-' . $datas['article_id']);

        return Response::json($loComment,200);
    }

    public function getIndexByArt()
	{
		$articleid = Input::get('article_id');

		$comments = Article::find($articleid)->comments()
                                               ->orderBy('id', 'asc')
                                               ->get();


		foreach ($comments as $cmt)
		{
			$cmt->user;
		}

        Cache::tags('comments')->put('comment-' . $articleid, $comments, 24 * 60);

		return Response::json($comments, 200);
	}

	public function upComment()
	{
		$validator = Validator::make(array(
			'id' => Input::get('comment_id')
		),
		array(
			'id' => 'required|numeric'
		));

        if(!$validator->fails())
        {
            $comemntId = Input::get('comment_id');

			$comments = Comment::find($comemntId)->increment('up',1);
        }

		return Response::json(array('up'=>'1'), 200);
	}
}