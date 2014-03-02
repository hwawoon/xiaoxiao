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
            "password" => Input::get("password")
        );

        $reg_rules = array(
            'name'=>'required|unique:users',
            'email'=>'required|email|unique:users',
            'password'=>'required|alpha_num'
        );

        //$messages = $validator->messages();
        $validator = Validator::make($postValues, $reg_rules);

        if ($validator->passes())
        {
            //get register user ip
            $registerIp = Request::getClientIp();

            $user = User::create(array(
                'name' => $postValues['name'],
                'email' => $postValues['email'],
                'password' => Hash::make($postValues['password']),
                'created_ip' => ip2long($registerIp),
                'last_login' => time(),
                'last_ip' => ip2long($registerIp)
            ));

            if(empty($user))
            {
                $messages = $validator->errors();
                $messages->add('reg_message', Lang::get('messages.reg_failure'));
                return Redirect::to('/register')->withErrors($messages)->withInput();
            }

            //register not send email
            Mail::queue('user.mail.welcome', array('username'=>Input::get("name")), function($message)
            {
                $message->to(Input::get("email"), Input::get("name"))->subject('感谢注册搞笑娃，请确认您的邮箱');
            });

            //login register user
            Auth::login($user, true);

            return Redirect::to('/');
        }
        else
        {
            return Redirect::to('/register')->withErrors($validator);
        }
    }

    public function getUserProfile()
    {
        $loginUser = Auth::user();

        $articles = $loginUser->articles()->get();


        return View::make('user.profile')->with("articles",$articles);
    }

    /**
     * update user basic info
     * @return mixed
     */
    public function saveUserBasicInfo()
    {
        $user = Auth::user();
        $user->introduction = Input::get('introduction');
        $result = $user->save();

        if($result)
        {
            return Redirect::back()->with('message',Lang::get('messages.save_success'));
        }
        else
        {
            return Redirect::back()->with('message',Lang::get('messages.save_fail'));
        }
    }

    /**
     * upload user temp image
     * @return mixed
     */
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
                return Response::json(array(
                    "state" => 0,
                    "type" => 'validation',
                    "message" => $validator->messages()->toJson()
                ),200);
            }

            $imgFile = Input::file('userSelectIcon');

            $extension = $imgFile->getClientOriginalExtension();
            $destinationPath = public_path();
            $filename = Str::random(32) . '.' . $extension;

            $upload_success = Img::resizeImage($imgFile, 300, 280, $destinationPath.'/temp/'.$filename);

            if($upload_success)
            {
                return Response::json(array(
                                        "state" => 1,
                                        "uploadimg" => $filename
                ));
            }
            else
            {
                return Response::json(array(
                    "state" => 0,
                    'type' => 'function',
                    'message' => Lang::get('messages.file_no_exist')
                ));
            }
        }
        else
        {
            //if file not exist
            return Response::json(array(
                "state" => 0,
                'type' => 'function',
                'message' => Lang::get('messages.file_no_exist')
            ));
        }
    }

    public function saveUserIcon()
    {
        if (Input::get('cropImgPath'))
        {
            try
            {
                //image source path
                $source_path = "temp/" . Input::get('cropImgPath');
                $source_info   = getimagesize($source_path);
                $source_width  = $source_info[0];
                $source_height = $source_info[1];
                $source_mime   = $source_info['mime'];

                $x = Input::get('x');
                $y = Input::get('y');
                $cropped_width = Input::get('w');
                $cropped_height = Input::get('h');

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

                $target_width = 128;
                $target_height = 128;

                $thumbImg = imagecreatetruecolor($target_width, $target_height);

                // copy image
                imagecopyresampled($thumbImg,$source_image,0, 0, $x, $y, $target_width,$target_width,$cropped_width,$cropped_height);

                // save image
                $result = imagejpeg($thumbImg ,public_path() .'/avatar/' .Input::get('cropImgPath') );

                //save user select path;
                $user = Auth::user();
                $updateUserId = $user->id;
                $originalPath = $user->avatar;

                $user->avatar =  'avatar/' .Input::get('cropImgPath');
                $user->save();

                //delete user original image
                if(is_readable($originalPath) && $originalPath != 'img/avatar.jpg')
                {
                    @unlink($originalPath);
                }

                imagedestroy($thumbImg);
                imagedestroy($source_image);

                //delete temp image
                if(is_readable($source_path))
                {
                    @unlink($source_path);
                }

                return Redirect::back()->with('message',Lang::get('messages.upload_avatar_success'));
            }
            catch(Exception $e)
            {
                return Redirect::back()->with('message',Lang::get('messages.avatar_system_error'));
            }
        }
        else
        {
            return Redirect::back()->with('message',Lang::get('messages.file_no_exist'));
        }
    }

    public function updatePassword()
    {
        $validator = Validator::make(
            array(
                'old_password' => \Illuminate\Support\Facades\Input::get('old_password'),
                'new_password' => \Illuminate\Support\Facades\Input::get('new_password'),
                'new_password_confirmation' => \Illuminate\Support\Facades\Input::get('new_password_confirmation')
            ),
            array(
                'old_password' => 'required|alpha_num',
                'new_password' => 'required|alpha_num|confirmed',
                'new_password_confirmation' => 'required|alpha_num'
            )
        );

        if ($validator->fails())
        {
            $errors = $validator->messages();
            if($errors->has())
            {
                $message = implode('<br>',$errors->all());
            }
            return Redirect::back()->with('message',$message);
        }
        else
        {
            $curUser = Auth::user();
            $currentPassword = $curUser->password;
            if($currentPassword != Hash::make(Input::get('old_password')))
            {
                return Redirect::back()->with('message', Lang::get('messages.current_password_error'));
            }
            else
            {
                $curUser->password = Hash::make(Input::get('new_password'));
                $curUser->save();

                return Redirect::back()->with('message', Lang::get('messages.update_password_success'));
            }
        }
    }
}