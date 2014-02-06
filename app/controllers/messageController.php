<?php

/**
 * Created by Kimhwawoon.
 * kimhwawoon@gmail.com
 * Date: 13-12-25
 */

class MessageController extends BaseController
{
    public function getMessage()
    {
        $userid = Auth::user()->getId();

        $messages = db::table('messages')->join('articles', 'articleid', '=', 'articles.id')
                            ->where('messages.to_userid',$userid)
                            ->where('messages.isnew',1)
                            ->orderBy('messages.created_at', 'desc')
                            ->select('messages.from_username','messages.articleid','articles.title','messages.from_username','messages.created_at')
                            ->groupBy('messages.articleid','messages.from_userid')
                            ->take(5)
                            ->get();

        return Response::json($messages,200);
    }

    public function getAllMessage()
    {
        $userid = Auth::user()->getId();

        $messages = db::table('messages')->join('articles', 'articleid', '=', 'articles.id')
            ->where('messages.to_userid',$userid)
            ->orderBy('messages.created_at', 'desc')
            ->select('messages.from_username','messages.articleid','articles.title','messages.from_username','messages.created_at')
            ->groupBy('messages.articleid','messages.from_userid')
            ->get();

        return View::make('user.setting.message')->with('messages',$messages);
    }
}