<?php

/**
 * Created by Kimhwawoon.
 * kimhwawoon@gmail.com
 * Date: 13-12-25
 */

class UserController extends BaseController
{

    /**
     * user sign in
     * do not send error message
     * all tip is "username or password is incorrect"
     */
    public function doLogin()
    {
        $validator = Validator::make(
            array(
                'password' => Input::get("password"),
                'email' => Input::get("email")
            ),
            array(
                'email' => 'required|email',
                'password' => 'required'
            )
        );

        if ($validator->fails())
        {
            return Response::json(array(
                "state" => 0,
                //'msg' => $validator->getMessageBag()->toArray()
            ));
        }
        else
        {
            $rememberme = Input::get('rememberme');

            $credentials = array(
                'email' => strtolower(Input::get('email')),
                'password' => Input::get('password')
            );

            if (Auth::attempt($credentials, $rememberme))
            {
                return Response::json(array("state" => 1));
            }
            else
            {
                return Response::json(array("state" => 0));
            }
        }
    }

    /**
     * flush session
     */
    public function logout()
    {
        try {
            Auth::logout();
            return Redirect::to('/');
        }
        catch (Exception $e)
        {
        }

    }

    /**
     * register new user
     * if register success , then log in
     * @return mixed
     */
    public function doRegister()
    {
        $postValues = array(
            "name" => Input::get("name"),
            "email" => Input::get("email"),
            "password" => Input::get("password"),
            "password_confirmation" => Input::get("password_confirmation")
        );

        $validator = Validator::make($postValues, User::$reg_rules);

        if ($validator->passes())
        {
            $registerIp = Request::getClientIp();

            $user = User::create(array(
                'name' => $postValues['name'],
                'email' => $postValues['email'],
                'password' => Hash::make($postValues['password']),
                'created_ip' => ip2long($registerIp)
            ));

            if(empty($user))
            {
                $messages = $validator->errors();
                $messages->add('reg_message', Lang::get('messages.reg_failure'));
                return Redirect::to('user/register')->withErrors($messages)->withInput();
            }

            //TO DO send eamil to set user active

            Auth::login($user, true);

            return Redirect::to('/');
        }
        else
        {
            return Redirect::to('user/register')->withErrors($validator);
        }
    }

    public function uploadIcon()
    {
        return "success";
    }

    public function getUserProfile()
    {
        $loginUser = Auth::user();

        $articles = DB::table('articles')->where('userid',$loginUser->id)->get();

        return View::make('user.profile')->with("pagetitle","个人主页")
                                         ->with("articles",$articles);
    }

    public function saveUserBasicInfo()
    {
        $updateUserId = Auth::user()->id;

        $affectedRows = User::where('id', $updateUserId)
                              ->update(array(
                                            'name' => Input::get('username'),
                                            'introduction' => Input::get('introduction')
                                        ));
        if($affectedRows > 0)
        {
            return Redirect::to('user/setting')->with('status', true)->with('message',"个人信息保存成功！");
        }
        else
        {
            return Redirect::to('user/setting')->with('status', false)->with('message',"个人信息保存失败！");
        }
    }

    public function uploadSourceImage()
    {
        if (Input::hasFile('userSelectIcon'))
        {
            $upload_rules = array(
                'userSelectIcon' => 'required|image|mimes:jpeg,png'
            );

            $validator = Validator::make(Input::all(), $upload_rules);

            if($validator->fails())
            {
                return Response::json(array("message" => $validator->messages()),400);
            }

            $imgFile = Input::file('userSelectIcon');

            $extension = $imgFile->getClientOriginalExtension();
            $destinationPath = public_path();
            $filename = Str::random(32) . '.' . $extension;
            $upload_success = $imgFile->move($destinationPath.'/temp/', $filename);

            if($upload_success)
            {
                return Response::json(array("uploadimg" => $filename));
            }
        }
    }

    public function saveUserIcon()
    {

        if (Input::get('cropImgPath'))
        {
            $source_path = "temp/" . Input::get('cropImgPath');
            $source_info   = getimagesize($source_path);
            $source_width  = $source_info[0];
            $source_height = $source_info[1];
            $source_mime   = $source_info['mime'];

            $x = Input::get('x');
            $y = Input::get('y');
            $w = Input::get('w');
            $h = Input::get('h');

            // 载入原图

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

            $width = 128;
            $height = 128;

            $thumbImg = imagecreatetruecolor($width, $height);
            // 复制图片
            imagecopyresampled($thumbImg, $source_image, 0, 0, 0, 0, $width, $height, $source_width,$source_height);

            // 生成图片

            $result = imagejpeg($thumbImg ,public_path() .'/avatar/' .Input::get('cropImgPath') );

            $updateUserId = Auth::user()->id;

            $affectedRows = User::where('id', $updateUserId)
                ->update(array(
                    'avatar' => 'avatar/' .Input::get('cropImgPath')
                ));

            imagedestroy($thumbImg);
            imagedestroy($source_image);
            return Response::json(array("message" => "头像上传成功！"));
        }
        else
        {
            return Response::json(array("message" => "图片不存在！"));
        }
    }

}