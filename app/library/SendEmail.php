<?php

class SendEmail {
	
	public function register($job,$data)
	{
		$user = $data['user'];
        $contactEmail = $user->email;
        $contactName = $user->name;
		//send eamil to set user active
        Mail::send('user.mail.welcome', array('username'=>$contactName), function($message) use ($contactEmail, $contactName)
        {
            $message->to($contactEmail, $contactName)->subject('搞笑娃欢迎您的加入！');
        });
	}
}