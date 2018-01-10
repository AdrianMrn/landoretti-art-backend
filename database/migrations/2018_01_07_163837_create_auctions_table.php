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
			$table->string('title')->unique();
			$table->integer('year');
			$table->integer('width');
			$table->integer('height');
			$table->integer('depth')->nullable()->default(null);
			$table->text('description');
			$table->text('condition');
			$table->text('origin');
			$table->integer('priceMinEst');
			$table->integer('priceMaxEst');
			$table->integer('priceBuyout')->nullable()->default(null);
			$table->date('endDate');
			$table->string('status')->default('active');
			$table->string('boughtBy')->nullable()->default(null);
			$table->string('imageSignature');
			$table->string('imageArtwork');
			$table->string('imageOptional')->nullable()->default(null);
		});
	}

	public function down()
	{
		Schema::drop('auctions');
	}
}