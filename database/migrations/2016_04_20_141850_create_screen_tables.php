<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScreenTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screens', function (Blueprint $table) {
            $table->increments('id');

            $table->timestamps();
        });

        Schema::create('screen_screen_group', function (Blueprint $table) {
            $table->integer('screen_group_id')->unsigned()->index();
            $table->foreign('screen_group_id')->references('id')->on('screengroups')->onDelete('cascade');
            $table->integer('screen_id')->unsigned()->index();
            $table->foreign('screen_id')->references('id')->on('screens')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('screen_id')->nullable();
            $table->foreign('screen_id')
                ->references('id')->on('screens');

            $table->string('name');
            $table->string('path');
            $table->string('thumb_path');
            $table->boolean('archived');
            $table->string('sha1');

            $table->timestamps();
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('screen_tag', function (Blueprint $table) {
            $table->integer('screen_id')->unsigned()->index();
            $table->foreign('screen_id')->references('id')->on('screens')->onDelete('cascade');
            $table->integer('tag_id')->unsigned()->index();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('screens');
        Schema::drop('screen_screen_group');
        Schema::drop('photos');
        Schema::drop('tags');
        Schema::drop('screen_tag');
    }
}
