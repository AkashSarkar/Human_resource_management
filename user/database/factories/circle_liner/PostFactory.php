<?php

use Faker\Generator as Faker;

$factory->define(App\cirle_liner_models\Post::class, function (Faker $faker){
    $award = array(
        'award_name'=>$faker->streetName,
        'award_receving_date'=>$faker->date(),
        'award_receving_place'=>$faker->address,
        'award_description'=>$faker->paragraph,
    ) ;
    $promotion=array(
        'new_job_position' => $faker->jobTitle,
        'company_name' => $faker->company,
        'department_name' =>$faker->text,
        'location' => $faker->city,
        'promotion_description' => $faker->paragraph,
    );
    $event=array(
        'event_name' =>$faker->name,
        'event_start_date' => $faker->date(),
        'event_end_date ' =>$faker->date(),
        'event_description' => $faker->paragraph
    );
    $article=array(
        'article_name' => $faker->domainName,
        'reference_link' => $faker->url,
        'publishing_date' =>$faker->date(),
        'article_description' => $faker->paragraph,
    );
    $conference=array(
        'conference_name' => $faker->streetName,
        'conference_topic' => $faker->sentence,
        'role' =>$faker->jobTitle,
        'conference_description' => $faker->paragraph
    );

    $project=array(
        'project_title' => $faker->name,
        'role' =>$faker->jobTitle,
        'project_start_date' =>$faker->date(),
        'skills_required' => $faker->sentence,
        'project_description' => $faker->paragraph
    );
$users = App\cirle_liner_models\User::pluck('id')->toArray();
    return [
        'hash_id' =>str_random(5),
        'post_data' => $faker->randomElement([json_encode($award),json_encode($project)],json_encode($article),
                                             json_encode($conference),json_encode($event),json_encode($promotion)),
        'post_type_id' =>rand(1,7),
        'user_id' =>$faker->randomElement($users),
    ];
});
//// ONE TO MANY relationship (with Users already created)
//$factory->define(App\Posts::class, function (Faker\Generator $faker) {
//    $users = App\User::pluck('id')->toArray();
//    return [
//        'user_id' => $faker->randomElement($users),
//        // Rest of attributes...
//    ];
//});
