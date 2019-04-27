<?php

use Faker\Generator as Faker;

$factory->define(App\Inventory::class, function (Faker $faker) {
    return [
        'product_id' => rand(1, 6),
        'amount' => rand(-2000, 2000),
        'created_by' => rand(1, 3)
    ];
});
