<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Screens extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('screens', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');

			// ScreenGroup
			$table->integer('screengroup_id')->unsigned();
			$table->foreign('screengroup_id')
			->references('id')->on('screengroups');

			// Event
			$table->integer('event_id')->unsigned()->nullable();
			$table->foreign('event_id')
			->references('id')->on('events');

			// Images
			$table->integer('image_id')->unsigned();
			$table->foreign('image_id')
			->references('id')->on('images');

			// Users
			$table->integer('created_by')->unsigned();
			$table->foreign('created_by')
			->references('id')->on('users');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('screens');
	}
}
