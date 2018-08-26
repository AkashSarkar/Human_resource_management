<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\cirle_liner_models\User::class,10)->create();
//        factory(App\cirle_liner_models\User::class, 5)->create()->each(function($u) {
//        $u->posts()->save(factory(App\cirle_liner_models\Post::class)->make());
//        });
        //$users = DB::connection('mysql2')->select(...);
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@hr.com',
            'password' => bcrypt('123456'),
            'role_id'=> 1,
            'created_at'=>\Carbon\Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
