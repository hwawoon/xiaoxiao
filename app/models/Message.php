<?php
/**
 * Created by kimhwawoon.
 * Date: 14-1-25 下午5:26
 * mail: kimhwawoon@gmail.com
 */

class Message extends Eloquent
{
    protected $fillable = array('sender_id', 'receiver_id', 'article_id', 'comment_id');

	public function article()
    {
        return $this->belongsTo('Article');
    }

    public function sender()
    {
        return $this->belongsTo('User');
    }

    public function receiver()
    {
        return $this->belongsTo('User');
    }

    public function comment()
    {
        return $this->belongsTo('Comment');
    }
}