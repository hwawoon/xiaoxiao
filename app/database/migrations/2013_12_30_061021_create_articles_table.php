<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('title');
            $table->string('imgpath');
            $table->string('thumbpath');
            $table->integer('user_id');
            $table->integer('comments');
            $table->integer('points');
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
        Schema::dropIfExists('articles');
	}

}
