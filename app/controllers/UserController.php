<?php
/**
 * Created by PhpStorm.
 * User: mini
 * Date: 13-12-25
 * Time: 下午4:55
 */

class UserController extends BaseController
{

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function getIndex()
    {
        return View::make('hello');
    }

    public function doLogin()
    {
        // validate the info, create rules for the inputs
        $rules = array(
            'email' => 'required|email', // make sure the email is an actual email
            'password' => 'required|min:6' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Response::json(array("state" => 0));
        } else {
            $userdata = array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            );

            $user = User::where('email', '=', $userdata['email'])->first();

            if ($user->getAuthPassword() == $userdata['password'])
            {
                Session::put('user', $user);
                return Response::json(array("state" => 1));
            }
            else
            {
                // validation not successful, send back to form
                return Response::json(array("state" => 0));
            }
        }
    }

    public function logout()
    {
        try {
            Session::flush();
            return Redirect::to('/');
        }
        catch (Exception $e)
        {
        }

    }

    public function doRegister()
    {
        $validator = Validator::make(Input::all(), User::$rules);

        if ($validator->passes())
        {
            $user = User::create(Input::all());

            Auth::login($user,true);

            Session::put("user",$user);

            return View::make('register.success', array('info' => "亲，注册成功！ 去邮箱确认邮件吧！"));
        }
        else
        {
            return Redirect::to('toRegister')->withErrors($validator);
        }
    }

    public function uploadIcon()
    {
        return "success";
    }
}