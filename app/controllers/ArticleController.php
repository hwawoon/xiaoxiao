<?php

/**
 * Created by Kimhwawoon.
 * kimhwawoon@gmail.com
 * Date: 13-12-25
 */

class ArticleController extends BaseController
{
    public function getArticle($id)
    {
        $article = Article::find($id);

        $pre_article = Article::where('id',"<", $id)->first();
        $next_article = Article::where('id',">", $id)->first();

        $article->increment('clicks');

        $rarticles = Article::orderBy('comments', 'desc')->skip(0)->take(5)->get();

        $vote = null;

        if(Auth::check())
        {
            $vote = $article->votes()
                ->where('user_id','=',Auth::user()->id)
                ->first();
        }

        return View::make('/article')->with('article',$article)
                                      ->with('previous',$pre_article)
                                      ->with('next',$next_article)
                                      ->with('vote',$vote)
                                      ->with('rarticles',$rarticles);
    }

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
                    "message" => $validator->messages()->first()
                ),200);
            }

            $extension = $imgFile->getClientOriginalExtension();
            $destinationPath = public_path().'/';
            $filename = Str::random(32) . '.' . $extension;
            $uploadSaveDir = $destinationPath.Article::$uploadpath. $filename;
            $upload_success = $imgFile->move($destinationPath.Article::$uploadpath, $filename);

            //裁剪图片
            $thumbnailResult = Img::imagecropper($uploadSaveDir,300,120,$destinationPath.Article::$thumbpath.$filename);

            $article = new Article();
            if(exif_imagetype($uploadSaveDir) == IMAGETYPE_GIF )
            {
                //get image info
                $source_info   = getimagesize($uploadSaveDir);
                $source_width  = $source_info[0];
                $source_height = $source_info[1];
                //截图
                $screenshotResult = Img::resizeImage($uploadSaveDir, $source_width, $source_height, $destinationPath.Article::$screenshotpath.$filename);
                $article->screenshot = Article::$screenshotpath.$filename;
                $article->gif = 1;
            }

            if( $upload_success && $thumbnailResult )
            {
                $article->title = $fileTitle;
                $article->imgpath = Article::$uploadpath . $filename;
                $article->thumbpath = Article::$thumbpath . $filename;
                $article->type = Input::get('uplaodType');
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
            'title' => 'required|max:200',
            'forwardType' => 'required|integer'
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
            $destinationPath = public_path() . '/';
            $filename = Str::random(32) . '.' . $urlSuffix;
            // Write the contents back to a new file
            $uploadSaveDir = $destinationPath.Article::$uploadpath.$filename;
            $putSize = file_put_contents($uploadSaveDir, $data);

            if( $putSize )
            {
                //裁剪图片
                $thumbnailResult = Img::imagecropper($uploadSaveDir,300,120,$destinationPath.Article::$thumbpath.$filename);

                $article = new Article();

                if(exif_imagetype($uploadSaveDir) == IMAGETYPE_GIF )
                {
                    //get image info
                    $source_info   = getimagesize($uploadSaveDir);
                    $source_width  = $source_info[0];
                    $source_height = $source_info[1];
                    //截图
                    $screenshotResult = Img::resizeImage($uploadSaveDir, $source_width, $source_height, $destinationPath.Article::$screenshotpath.$filename);
                    $article->screenshot = Article::$screenshotpath.$filename;

                    $article->gif = 1;
                }

                $article->title = $inputValues['title'];
                $article->imgpath = Article::$uploadpath . $filename;
                $article->thumbpath = Article::$thumbpath . $filename;
                $article->user_id = Auth::user()->getId();
                $article->type = Input::get('forwardType');
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

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return Response
     */
    public function destroy()
    {
        $article = Article::find(Input::get('articleid'));

        if(Auth::user()->id == $article->user->id)
        {
            $article->delete();
            $affectedRows = Message::where('article_id', '=', Input::get('articleid'))
                                   ->delete();
            return Redirect::back()->with('message',Lang::get('messages.auth_error'));
        }
        else
        {
            return Redirect::back()->with('message',Lang::get('messages.deleted_article'));
        }
    }
}