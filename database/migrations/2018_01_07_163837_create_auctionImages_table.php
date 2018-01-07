<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuctionImagesTable extends Migration {

	public function up()
	{
		Schema::create('auctionImages', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('auctionId')->unsigned();
			$table->string('imageUrl');
			$table->integer('signature')->default('0');
			$table->integer('mainImage')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('auctionImages');
	}
}