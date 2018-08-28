<?php
/**
 * Created by PhpStorm.
 * User: deepiuiu
 * Date: 26/08/18
 * Time: 22:19
 */
use Faker\Generator as Faker;
use Modules\Department\Models\DepartmentModel as model;
$factory->define(model::class, function (Faker $faker) {
    $des=array(
        $faker->jobTitle,
        $faker->jobTitle);
    return [

        'department'=>$faker->jobTitle,
        'designation'=>json_encode($des)

    ];
});