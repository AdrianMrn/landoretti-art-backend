<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBidsTable extends Migration {

	public function up()
	{
		Schema::create('bids', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('userId')->unsigned();
			$table->integer('amount');
			$table->integer('auctionId')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('bids');
	}
}