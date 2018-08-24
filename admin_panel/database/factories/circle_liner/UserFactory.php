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

/*$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});*/

$factory->define(App\cirle_liner_models\User::class, function (Faker $faker) {
    //static $password;

    return [
        'hash_id' =>str_random(5),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'gender'=>$faker->randomElement(['female','male']),
        'dob'=>$faker->date(),
        'status'=>rand(0,1),
        'role_id'=>rand(1,5),
       // 'email' => $faker->email,
       // 'password' =>$password ?: $pssword=bcrypt('secret'),

    ];
});
