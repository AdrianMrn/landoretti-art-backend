<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWatchlistItemsTable extends Migration {

	public function up()
	{
		Schema::create('watchlistItems', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('userId')->unsigned();
			$table->integer('auctionId')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('watchlistItems');
	}
}