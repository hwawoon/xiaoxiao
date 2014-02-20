<?php

/**
 * Created by Kimhwawoon.
 * kimhwawoon@gmail.com
 * Date: 13-12-25
 */

class ArticleController extends BaseController
{
    /**
     * user upload new image
     * @return mixed
     */
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
                    "message" => implode('<br>',$validator->messages())
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
                $article->imgpath = 'upload/' . $filename;
                $article->thumbpath = 'thumbnail/' . $filename;
                $article->user_id = Auth::user()->getId();

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
                    "message" => Lang::get('messages.avatar_system_error')
                ),200);
            }
        }
        else
        {
            return Response::json(array(
                "state" => 0,
                "message" => Lang::get('messages.file_no_exist')
            ),200);
        }
    }

    //upload other site image
    public function forwardImageArticle()
    {
        $inputValues = array(
            'forwardUrl' => Input::get('forwardUrl'),
            'title' => Input::get('title')
        );

        $validator = Validator::make(Input::all(), array(
            'forwardUrl' => 'required|url',
            'title' => 'required|max:200'
        ));

        if($validator->fails())
        {
            return Response::json(array(
                "state" => 0,
                "message" => implode('<br>',$validator->messages())
            ),200);
        }

        //validate url suffix
        $urlSuffix = strtoupper(substr(strrchr($inputValues['forwardUrl'], '.'), 1));
        if($urlSuffix == 'JPG' || $urlSuffix == 'GIF' || $urlSuffix == 'PNG')
        {
            $data = file_get_contents($inputValues['forwardUrl']);

            // New file
            $destinationPath = public_path() . '/upload/';
            $filename = Str::random(32) . '.' . $urlSuffix;
            // Write the contents back to a new file
            $putSize = file_put_contents($destinationPath.$filename, $data);

            if( $putSize )
            {
                //裁剪图片
                $thumbnailResult = Img::imagecropper($destinationPath.$filename,300,120,public_path().'/thumbnail/'.$filename);

                $article = new Article();
                $article->title = $inputValues['title'];
                $article->imgpath = 'upload/' . $filename;
                $article->thumbpath = 'thumbnail/' . $filename;
                $article->user_id = Auth::user()->getId();
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
                    "message" => Lang::get('messages.upload_failure')
                ),200);
            }
        }
        else
        {
            return Response::json(array(
                "state" => 0,
                "message" => Lang::get('messages.uplaod_format_error')
            ),200);
        }
    }

    public function getArticle($id)
    {
        $article = Article::find($id);

        $pre_article = Article::where('id',"<", $id)->first();
        $next_article = Article::where('id',">", $id)->first();

        $previous = !empty($pre_article);
        $next = !empty($next_article);

        $rarticles = Article::orderBy('comments', 'desc')->skip(0)->take(5)->get();

        $loAllComments = Article::find($id)->comments;

        $loAllComments = array();

        return View::make('/article')->with('article',$article)
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

    public function deleteArticle()
    {
        $id = Input::get('articleid');
        DB::table('articles')->where('id', $id )->delete();

        return Redirect::to('user/profile')->with('delmessage',Lang::get('messages.deleted_article'));
    }
}