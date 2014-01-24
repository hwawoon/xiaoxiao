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
        'title'=>'required',
        'uploadImage' => 'required|mimes:jpeg,gif,png|max:3000'
    );

    protected $fillable = array('title', 'savepath', 'thumbnailpath', 'userid');
}