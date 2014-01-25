<?php
/**
 * Created by kimhwawoon.
 * Date: 14-1-25 下午5:26
 * mail: kimhwawoon@gmail.com 
 */

class Message extends Eloquent
{
    protected $fillable = array('from_user', 'to_user', 'articleid', 'isnew');
}