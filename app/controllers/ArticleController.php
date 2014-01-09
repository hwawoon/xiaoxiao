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

            if( $upload_success )
            {
                $article = new Article();

                $article->title = $fileTitle;
                $article->savepath = 'upload/' . $filename;
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

    public function getArticle($id)
    {
        $article = DB::table('articles')->where('id', $id)->first();

        $loAllComments = DB::table('comments')
                            ->join('users', 'users.id', '=', 'comments.userid')
                            ->where('comments.articleid',$article->id)
                            ->orderBy('comments.created_at', 'desc')
                            ->select('comments.content','users.name','comments.created_at')
                            ->get();

        return View::make('/article/article')->with('article',$article)
                                              ->with('comments',$loAllComments);
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

}