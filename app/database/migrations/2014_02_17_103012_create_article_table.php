<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('article', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id');
			$table->integer('channel_id');
			$table->string('title');
			$table->string('slug');
			$table->text('teaser');
			$table->text('markdown');
			$table->text('html');
			$table->string('key')->nullable();
			$table->text('metadata')->nullable();
			$table->string('access');

			$table->index('user_id');
			$table->index('channel_id');
			$table->index('key');

			$table->unique(array('channel_id', 'slug'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('article');
	}

}
