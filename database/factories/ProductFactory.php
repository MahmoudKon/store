<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Product::class, function (Faker $faker) {

    return [
        'category_id'    => $faker->numberBetween(1, 10),
        'ar'             => ['name'  => $faker->sentence(6), 'description' => $faker->sentence(15) . ' desc'],
        'en'             => ['name'  => $faker->sentence(6), 'description' => $faker->sentence(15) . ' desc'],
        'es'             => ['name'  => $faker->sentence(6), 'description' => $faker->sentence(15) . ' desc'],
        'purchase_price' => $faker->numberBetween(1000, 2000),
        'sale_price'     => $faker->numberBetween(3000, 5000),
        'stock'          => $faker->numberBetween(0, 100),
        'discount'       => $faker->numberBetween(0, 100),
        'start_discount' => date('m/d/Y'),
        'end_discount'   => date('9/30/2019'),
    ];
});
