<?php
use Illuminate\Support\Facades\Hash;
use App\Item;
use Faker\Generator as Faker;
$factory->define(Item::class, function ($faker) {
	return[
		'name' => $faker->name,
		'price' =>$faker->randomNumber,
		'image' => $faker->image('public\upload',300,300, null, false),
	];
});
