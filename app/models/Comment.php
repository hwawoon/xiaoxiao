<?php
/**
 * Created by PhpStorm.
 * User: mini
 * Date: 14-1-9
 * Time: 上午11:42
 */

class Comment extends Eloquent
{
    public function article()
    {
        return $this->belongsTo('Article');
    }
}