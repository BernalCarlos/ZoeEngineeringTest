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

$factory->define(App\Models\Agent::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'age' => $faker->numberBetween(22, 68),
        'gender' => $faker->randomElement(['M', 'F']),
        'zip_code' => $faker->postcode,
        'email' => $faker->email,
        'password' => \Illuminate\Support\Facades\Hash::make($faker->password()),
    ];
});
