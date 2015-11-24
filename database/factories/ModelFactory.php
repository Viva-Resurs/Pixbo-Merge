<?php

use App\ScreenGroup;
use App\Ticker;
use App\User;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
 */

$factory->define(User::class, function (Generator $faker) {
	return [
		'name'           => $faker->name,
		'email'          => $faker->email,
		'password'       => bcrypt(str_random(10)),
		'remember_token' => str_random(10),
	];
});

$factory->define(ScreenGroup::class, function (Generator $faker) {
	return [
		'name' => $faker->name,
		'desc' => $faker->sentence,
	];
});

$factory->define(App\Ticker::class, function (Faker\Generator $faker) {
	return [
		'text'            => $faker->paragraph,
		'screen_group_id' => 1,
	];
});