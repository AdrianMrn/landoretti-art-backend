<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuctionsTable extends Migration {

	public function up()
	{
		Schema::create('auctions', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('userId')->unsigned();
			$table->string('style');
			$table->string('title');
			$table->integer('year');
			$table->integer('width');
			$table->integer('height');
			$table->integer('depth')->nullable()->default('0');
			$table->text('description');
			$table->text('condition');
			$table->text('origin');
			$table->integer('priceMinEst');
			$table->integer('priceMaxEst');
			$table->integer('priceBuyout')->nullable()->default(null);
			$table->datetime('endDate');
			$table->string('status')->default('pending');
			$table->string('boughtBy')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('auctions');
	}
}