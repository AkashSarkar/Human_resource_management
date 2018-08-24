<?php

use Illuminate\Database\Seeder;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            'name' => 'User',
            'tag' => 'user'
        ]);
        DB::table('modules')->insert([
            'name' => 'Permissions',
            'tag' => 'permissions'
        ]);
        DB::table('modules')->insert([
            'name' => 'Menu',
            'tag' => 'menu'
        ]);
        DB::table('modules')->insert([
            'name' => 'Dashboard',
            'tag' => 'dashboard'
        ]);
        DB::table('modules')->insert([
            'name' => 'Setting',
            'tag' => 'setting'
        ]);
        DB::table('modules')->insert([
            'name' => 'Like',
            'tag' => 'like'
        ]);
        DB::table('modules')->insert([
            'name' => 'Industry',
            'tag' => 'industry'
        ]);
        DB::table('modules')->insert([
            'name' => 'Profession',
            'tag' => 'profession'
        ]);
        DB::table('modules')->insert([
            'name' => 'Education',
            'tag' => 'education'
        ]);
        DB::table('modules')->insert([
            'name' => 'Company',
            'tag' => 'company'
        ]);
        DB::table('modules')->insert([
            'name' => 'Post',
            'tag' => 'post'
        ]);

    }
}
