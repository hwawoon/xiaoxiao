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
	public function destroy($id)
	{
		//
	}

    public function addComment($userid,$articleid)
    {
        $loComment = new Comment();

        $loComment->content = Input::get('myComment');
        $loComment->articleid = $articleid;
        $loComment->userid = $userid;
        $loComment->save();

        DB::table('articles')->where('id', $articleid)->increment('comments',1);

        $inssertComment = DB::table('comments')
                            ->join('users', 'users.id', '=', 'comments.userid')
                            ->where('comments.id',$loComment->id)
                            ->select('comments.content','users.name','users.avatar','comments.created_at')
                            ->get();

        return Response::json($inssertComment,200);
    }
}