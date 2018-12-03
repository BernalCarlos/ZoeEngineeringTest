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

$factory->define(App\Models\Contact::class, function (Faker $faker) {
    $allProfessionIds = DB::table('contact_professions')->pluck('id');

    return [
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'age' => $faker->numberBetween(27, 65),
        'gender' => $faker->randomElement(['M', 'F']),
        'zip_code' => $faker->postcode,
        'profession_id' => $faker->randomElement($allProfessionIds),
        'email' => $faker->email,
    ];
});