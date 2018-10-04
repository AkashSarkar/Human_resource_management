<?php
/**
 * Created by PhpStorm.
 * User: deepiuiu
 * Date: 26/08/18
 * Time: 22:19
 */
use Faker\Generator as Faker;
use Modules\Award\Models\AwardModel as model;
use Modules\User\Models\EmployeeModel as User;
$factory->define(model::class, function (Faker $faker) {
    $uid=User::pluck('id')->toArray();
    return [

        'user_id'=>$faker->randomElement($uid),
        'award'=>"Best Employee",
        'month'=>$faker->time('Y-m','now'),
        'gift'=>10000

    ];
});