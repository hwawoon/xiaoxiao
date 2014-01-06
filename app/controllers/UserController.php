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
        $rules = array(
            'email' => 'required|email',
            'password' => 'required|min:6'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Response::json(array("state" => 0));
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
                // The user is being remembered...
                Session::put('user', Auth::user());
                return Response::json(array("state" => 1));
            }
            else
            {
                return Response::json(array("state" => 0));
            }
        }
    }

    public function logout()
    {
        try {
            Session::flush();
            Auth::logout();
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
            User::create(Input::all());

            return View::make('register.success');
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
}