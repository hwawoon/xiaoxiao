<?php
/**
 * Created by PhpStorm.
 * User: kimi
 * Date: 14-1-4
 * Time: 下午11:00
 */

class ArticleController extends BaseController
{

    public function uploadImageArticle()
    {
        if (Input::hasFile('uploadImage'))
        {
            $imgFile = Input::file('uploadImage');
            $extension = Input::file('uploadImage')->getClientOriginalExtension();
            $size = Input::file('uploadImage')->getSize();
            $fileTitle = Input::get('title');

            $validate_data = array(
                "uploadfile" => $imgFile,
                "title" => $fileTitle
            );

            $validator = Validator::make(Input::all(), Article::$upload_rules);

            if($validator->fails())
            {
                return Response::json('error', 400);
            }

            $destinationPath = public_path();
            $filename = Str::random(32) . '.' . $extension;

            //$upload_success = Input::file('uploadImage')->move($destinationPath, $filename);
            $upload_success = Input::upload('image', 'public', $filename);

            if( $upload_success )
            {
                $article = array(
                    "title" => $fileTitle,
                    "savepath" => $filename,
                    "userid" => Session::get('user')->getId()
                );

                $article->save();

                return View::make('register.success');
            } else {
                return View::make('error');
            }
        }
        else
        {
            return Response::json('error', 400);
        }

        $credentials = array(
            'title' => Input::get('title'),
            'password' => Input::get('uploadImage')
        );
    }
}