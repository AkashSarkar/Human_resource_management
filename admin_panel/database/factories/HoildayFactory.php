<?php
/**
 * Created by PhpStorm.
 * User: deepiuiu
 * Date: 26/08/18
 * Time: 22:19
 */
use Faker\Generator as Faker;
use Modules\Holiday\Models\HolidayModel as model;
$factory->define(model::class, function (Faker $faker) {
    return [

        'day'=>$faker->time('Y-m-d','now'),
        'event'=>$faker->text,

    ];
});