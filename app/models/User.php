<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

    protected $softDelete = true;

    protected $fillable = array(
        'name',
        'email',
        'password',
        'created_ip',
        'last_login',
        'last_ip'
    );

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

    public function articles()
    {
        return $this->hasMany('Article');
    }

    public function messages()
    {
    	return $this->hasMany('Message','receiver_id');
    }

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

    public function getId()
    {
        return $this->id;
    }

    public function getUserName()
    {
        return $this->name;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

}