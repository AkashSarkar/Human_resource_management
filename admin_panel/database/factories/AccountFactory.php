<?php
/**
 * Created by PhpStorm.
 * User: deepiuiu
 * Date: 26/08/18
 * Time: 22:19
 */
use Faker\Generator as Faker;
use Modules\User\Models\AccountModel as model;
use Modules\User\Models\EmployeeModel as User;
$factory->define(model::class, function (Faker $faker) {

    $uid=User::pluck('id')->toArray();
    return [
        'ac_name'=>$faker->name,
        'ac_number'=>$faker->bankAccountNumber,
        'bank'=>$faker->domainName,
        'ifsc'=>$faker->postcode,
        'pan'=>$faker->phoneNumber,
        'branch'=>$faker->city,
        'user_id'=>$faker->randomElement($uid),
    ];
});