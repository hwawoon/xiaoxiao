<?php

/**
 * Event
 */
Event::listen('user.login', function($param)
{
    $user = Auth::user();
    $user->last_login= time();
    $loginIp = Request::getClientIp();
    $user->last_ip= ip2long($loginIp);
    $user->save();
    $user->touch();
});