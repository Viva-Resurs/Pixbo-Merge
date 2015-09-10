<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Events extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('events', function (Blueprint $table) {
			$table->increments('id');

			$table->date('date');
			$table->time('start_time');
			$table->time('end_time');
			$table->boolean('recurring');
			$table->integer('eventable_id');
			$table->string('eventable_type');

			$table->integer('event_meta_id')->unsigned()->nullable();
			$table->foreign('event_meta_id')
			->references('id')->on('eventmetas');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('events');
	}
}
