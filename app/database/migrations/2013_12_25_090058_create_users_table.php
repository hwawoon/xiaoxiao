<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('users', function($table)
        {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('name')->unique();
            $table->string('password');
            $table->string('avatar')->default("img/logo.png");
            $table->string('introduction');
            $table->integer('created_ip');
            $table->integer('last_login');
            $table->integer('last_ip');
            $table->smallInteger('is_actived');
            $table->timestamps();
            $table->softDeletes();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('users');
	}

}