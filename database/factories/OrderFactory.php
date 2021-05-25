<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Models\Customer;
use App\Models\Order;

$factory->define(Order::class, function (Faker $faker) {
    $customerId = Customer::all()->pluck('id')->toArray();
    return [
        'total' => $faker->numberBetween(100, 99999),
        'date' => $faker->dateTimeBetween('+0 days', '+1 month'),
        'customer_id' => $faker->randomElement($customerId),
    ];
});
