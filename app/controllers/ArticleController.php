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
                return Response::json(array(
                    "state" => 0,
                    "type" => 'validation',
                    "message" => $validator->messages()->toJson()
                ),200);
            }

            $extension = $imgFile->getClientOriginalExtension();
            $destinationPath = public_path();
            $filename = Str::random(32) . '.' . $extension;
            $upload_success = $imgFile->move($destinationPath.'/upload', $filename);

            //裁剪图片
            $thumbnailResult = Img::imagecropper($destinationPath.'/upload/'.$filename,300,120,$destinationPath.'/thumbnail/'.$filename);

            if( $upload_success && $thumbnailResult )
            {
                $article = new Article();

                $article->title = $fileTitle;
                $article->savepath = 'upload/' . $filename;
                $article->thumbnailpath = 'thumbnail/' . $filename;
                $article->userid = Auth::user()->getId();

                $article->save();

                $insertedId = $article->id;

                $url = route('getArticle', [$insertedId]);

                return Response::json(array(
                    "state" => 1,
                    "url" => $url
                ),200);
        }
            else
            {
                return Response::json(array(
                    "state" => 0,
                    "type" => 'function',
                    "message" => Lang::get('messages.upload_failure')
                ),200);
            }
        }
        else
        {
            return Response::json(array(
                "state" => 0,
                "type" => 'function',
                "message" => Lang::get('messages.file_no_exist')
            ),200);
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
                            ->orderBy('comments.id', 'desc')
                            ->select('comments.id','comments.haschild','comments.content','users.name','users.avatar','comments.created_at')
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

    public function deleteArticle()
    {
        $id = Input::get('articleid');
        DB::table('articles')->where('id', $id )->delete();

        return Redirect::to('user/profile')->with('delmessage',Lang::get('messages.deleted_article'));
    }
}