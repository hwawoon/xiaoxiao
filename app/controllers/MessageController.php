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
        $user = Auth::user();

        $messages = $user->messages()
                        ->where('read_flag', '=', '0')
                        ->orderBy('created_at','desc')
                        ->skip(0)
                        ->take(5)->get();

        foreach ($messages as $msg)
        {
            $msg->article;
            $msg->sender;
        }

        return Response::json($messages,200);
    }

    public function getAllMessage()
    {
        $user = Auth::user();

        $messages = $user->messages()
                        ->where('read_flag', '=', '0')
                        ->orderBy('created_at','desc')
                        ->paginate(10);

        $rarticles = Article::orderBy('comments', 'desc')
                            ->skip(0)
                            ->take(10)
                            ->get();

        return View::make('user.message')->with('messages',$messages)
                                            ->with('rarticles',$rarticles);
    }

    public function ingnoreMessages()
    {
        $affectedRows = Message::where('receiver_id', '=', Auth::user()->id)
                               ->update(array('read_flag' => 1));

        return Redirect::to('user/message');
    }
}