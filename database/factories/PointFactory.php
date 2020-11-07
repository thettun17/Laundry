<?php
use Illuminate\Support\Facades\Hash;
use App\Point;
use Faker\Generator as Faker;
$factory->define(Point::class, function ($faker) {
	return[
		'type' => $faker->unique()->randomNumber,
		'amount' =>$faker->unique()->randomNumber,
	];
});