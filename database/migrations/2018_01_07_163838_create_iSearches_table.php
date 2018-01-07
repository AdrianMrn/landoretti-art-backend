<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateISearchesTable extends Migration {

	public function up()
	{
		Schema::create('iSearches', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('userId')->unsigned();
			$table->string('title');
			$table->string('description');
			$table->integer('approved')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('iSearches');
	}
}