<?php

/**
 * Created by Kimhwawoon.
 * kimhwawoon@gmail.com
 * Date: 13-12-25
 */

class ArticleController extends BaseController
{
    public function uploadImageArticle()
    {
        if (Input::hasFile('uploadImage'))
        {
            $imgFile = Input::file('uploadImage');
            $fileTitle = Input::get('title');

            $validator = Validator::make(Input::all(), Article::$upload_rules);

            if($validator->fails())
            {
                return Response::json(array("message" => $validator->messages()),400);
            }

            $extension = $imgFile->getClientOriginalExtension();
            $destinationPath = public_path();
            $filename = Str::random(32) . '.' . $extension;
            $upload_success = $imgFile->move($destinationPath.'/upload', $filename);

            //裁剪图片
            $thumbnailResult = $this->imagecropper($destinationPath.'/upload/'.$filename,300,100,$destinationPath.'/thumbnail/'.$filename);

            if( $upload_success && $thumbnailResult )
            {
                $article = new Article();

                $article->title = $fileTitle;
                $article->savepath = 'upload/' . $filename;
                $article->thumbnailpath = 'thumbnail/' . $filename;
                $article->userid = Auth::user()->getId();

                $article->save();

                return Response::json(array("message" => "图片上传成功！"),200);
            }
            else
            {
                return Response::json(array("message" => "图片上传失败，请联系管理员！"),400);
            }
        }
        else
        {
            return Response::json(array("message" => "发布失败！"),400);
        }
    }

    public function getRecommendArticle()
    {
        $articles = DB::table('articles')->orderBy('comments', 'desc')->skip(0)->take(5)->get();

        return $articles;
    }

    public function getArticle($id)
    {
        $article = DB::table('articles')->where('id', $id)->first();

        $pre_article = DB::table('articles')->where('id',"<", $id)->first();
        $next_article = DB::table('articles')->where('id',">", $id)->first();

        $previous = !empty($pre_article);
        $next = !empty($next_article);

        $rarticles = $this->getRecommendArticle();

        $loAllComments = DB::table('comments')
                            ->join('users', 'users.id', '=', 'comments.userid')
                            ->where('comments.articleid',$article->id)
                            ->orderBy('comments.created_at', 'desc')
                            ->select('comments.content','users.name','users.avatar','comments.created_at')
                            ->get();

        return View::make('/article/article')->with('article',$article)
                                              ->with('comments',$loAllComments)
                                              ->with('previous',$previous)
                                              ->with('next',$next)
                                              ->with('rarticles',$rarticles);
    }

    public function previousArticle($id)
    {
        $article = DB::table('articles')->where('id',"<", $id)->first();

        return $this->getArticle($article->id);
    }

    public function nextArticle($id)
    {
        $article = DB::table('articles')->where('id',">", $id)->first();

        return $this->getArticle($article->id);
    }

    public function articlePointUp()
    {
        $id = Input::get("id");
        DB::table('articles')->where('id', $id)->increment('up',1);
        return Response::json(array("state" => 1),200);
    }

    public function articlePointDown()
    {
        $id = Input::get("id");
        DB::table('articles')->where('id', $id)->increment('down',1);
        return Response::json(array("state" => 1),200);
    }

    function imagecropper($source_path, $target_width, $target_height, $target_path)
    {
        $source_info   = getimagesize($source_path);
        $source_width  = $source_info[0];
        $source_height = $source_info[1];
        $source_mime   = $source_info['mime'];
        $source_ratio  = $source_height / $source_width;
        $target_ratio  = $target_height / $target_width;

        // 源图过高
        if ($source_ratio > $target_ratio)
        {
            $cropped_width  = $source_width;
            $cropped_height = $source_width * $target_ratio;
            $source_x = 0;
            $source_y = ($source_height - $cropped_height) / 2;
        }
        // 源图过宽
        elseif ($source_ratio < $target_ratio)
        {
            $cropped_width  = $source_height / $target_ratio;
            $cropped_height = $source_height;
            $source_x = ($source_width - $cropped_width) / 2;
            $source_y = 0;
        }
        // 源图适中
        else
        {
            $cropped_width  = $source_width;
            $cropped_height = $source_height;
            $source_x = 0;
            $source_y = 0;
        }

        switch ($source_mime)
        {
            case 'image/gif':
                $source_image = imagecreatefromgif($source_path);
                break;

            case 'image/jpeg':
                $source_image = imagecreatefromjpeg($source_path);
                break;

            case 'image/png':
                $source_image = imagecreatefrompng($source_path);
                break;

            default:
                return false;
                break;
        }

        $target_image  = imagecreatetruecolor($target_width, $target_height);
        $cropped_image = imagecreatetruecolor($cropped_width, $cropped_height);

        // 裁剪
        imagecopy($cropped_image, $source_image, 0, 0, $source_x, $source_y, $cropped_width, $cropped_height);
        // 缩放
        imagecopyresampled($target_image, $cropped_image, 0, 0, 0, 0, $target_width, $target_height, $cropped_width, $cropped_height);

        imagedestroy($source_image);
        imagedestroy($cropped_image);

        $result = imagejpeg($target_image,$target_path);

        imagedestroy($target_image);

        return $result;
    }
}