<?php
use Illuminate\Support\Facades\Hash;
use App\Order;
use Faker\Generator as Faker;
$factory->define(Order::class, function ($faker) {
	$date = date('Y-m-d');
	return[
		'user_id' => 2,
		'address' => $faker->name,
		'phone_number' => $faker->randomNumber,
		'amount' => $faker->randomNumber,
		'pickup_date' => $date,
		'delivery_date' => $date,

	];
});