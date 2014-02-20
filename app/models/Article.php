<?php
/**
 * Created by PhpStorm.
 * User: mini
 * Date: 13-12-30
 * Time: 下午2:24
 */

class Article extends Eloquent
{
    public static $upload_rules = array(
        'title'=>'required|max:200',
        'uploadImage' => 'required|mimes:jpeg,gif,png|max:3000'
    );

    protected $fillable = array('title', 'imgpath', 'thumbpath', 'userid');

    /**
     * one article has many comments
     * @return mixed
     */
    public function comments()
    {
        return $this->hasMany('Comment');
    }

    public function votes()
    {
        return $this->hasMany('Vote');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

}