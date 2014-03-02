<?php

/**
 * Created by Kimhwawoon.
 * kimhwawoon@gmail.com
 * Date: 13-12-25
 */

class BaseController extends Controller
{

    //TODO optimize query sql
    function __construct()
    {
//        if(Auth::check())
//        {
//            $count = DB::table('messages')
//                ->where('to_userid',Auth::user()->id)
//                ->where('isnew',1)
//                ->groupby('from_userid','articleid')
//                ->get();
//
//            Session::put('message_count', count($count));
//        }
    }
}