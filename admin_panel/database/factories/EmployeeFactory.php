<?php
/**
 * Created by PhpStorm.
 * User: deepiuiu
 * Date: 26/08/18
 * Time: 22:19
 */
use Faker\Generator as Faker;
use Modules\User\Models\EmployeeModel as model;
$factory->define(model::class, function (Faker $faker) {

    return [


        'name'=>$faker->name,
        'email'=>$faker->email,
        'password'=>bcrypt('123456'),
        'f_name'=>$faker->name,
        'gender'=>"male",
        'phone'=>"0".rand(1688200144,1699200144),
        'dob'=>$faker->time('Y-m-d H:i:s','now'),
        'p_address'=>$faker->address,
        'l_address' => $faker->address,
        'remember_token' => str_random(10),
        'role_id'=> 1,

    ];
});