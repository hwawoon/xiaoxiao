<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('messages', function($table)
        {
            $table->increments('id');
            $table->integer('sender_id');
            $table->integer('receiver_id');
            $table->integer('comment_id');
            $table->integer('article_id');
            $table->smallInteger('read_flag');
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
		//
		Schema::drop('messages');
	}

}
