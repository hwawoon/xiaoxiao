<?php
/**
 * Created by PhpStorm.
 * User: mini
 * Date: 13-12-30
 * Time: 下午2:24
 */

class Vote extends Eloquent
{

    protected $fillable = array('article_id', 'user_id', 'state');

    public function article()
    {
        return $this->belongsTo('Article');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

}