<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('auctions', function(Blueprint $table) {
			$table->foreign('userId')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('auctionImages', function(Blueprint $table) {
			$table->foreign('auctionId')->references('id')->on('auctions')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('iSearches', function(Blueprint $table) {
			$table->foreign('userId')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('bids', function(Blueprint $table) {
			$table->foreign('userId')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('bids', function(Blueprint $table) {
			$table->foreign('auctionId')->references('id')->on('auctions')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('watchlistItems', function(Blueprint $table) {
			$table->foreign('userId')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('watchlistItems', function(Blueprint $table) {
			$table->foreign('auctionId')->references('id')->on('auctions')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('auctions', function(Blueprint $table) {
			$table->dropForeign('auctions_userId_foreign');
		});
		Schema::table('auctionImages', function(Blueprint $table) {
			$table->dropForeign('auctionImages_auctionId_foreign');
		});
		Schema::table('iSearches', function(Blueprint $table) {
			$table->dropForeign('iSearches_userId_foreign');
		});
		Schema::table('bids', function(Blueprint $table) {
			$table->dropForeign('bids_userId_foreign');
		});
		Schema::table('bids', function(Blueprint $table) {
			$table->dropForeign('bids_auctionId_foreign');
		});
		Schema::table('watchlistItems', function(Blueprint $table) {
			$table->dropForeign('watchlistItems_userId_foreign');
		});
		Schema::table('watchlistItems', function(Blueprint $table) {
			$table->dropForeign('watchlistItems_auctionId_foreign');
		});
	}
}