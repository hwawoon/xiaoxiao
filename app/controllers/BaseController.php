<?php

/**
 * Created by Kimhwawoon.
 * kimhwawoon@gmail.com
 * Date: 13-12-25
 */

class BaseController extends Controller
{

    function __construct()
    {
        if(Auth::check())
        {
            $count = DB::table('messages')
                ->where('to_user',Auth::user()->id)
                ->count();

            Session::put('message_count', $count);
        }
    }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}