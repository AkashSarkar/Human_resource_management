<?php
/**
 * Created by PhpStorm.
 * User: deepiuiu
 * Date: 26/08/18
 * Time: 22:19
 */
use Faker\Generator as Faker;
use Modules\Expense\Models\ExpenseModel as Expense;
$factory->define(Expense::class, function (Faker $faker) {
    return [

        'item'=>$faker->colorName,
        'purchase_from'=>$faker->city,
        'purchase_date'=>$faker->time('Y-m-d H:i:s','now'),
        'price'=>rand(1000,90000),

    ];
});