<?php
/**
 * Created by PhpStorm.
 * User: deepiuiu
 * Date: 26/08/18
 * Time: 22:19
 */
use Faker\Generator as Faker;
use Modules\Notice\Models\NoticeModel as model;
$factory->define(model::class, function (Faker $faker) {
    return [

        'title'=>$faker->jobTitle,
        'description'=>$faker->text,

    ];
});