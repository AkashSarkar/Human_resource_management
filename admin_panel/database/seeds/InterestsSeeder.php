<?php

use Illuminate\Database\Seeder;

class InterestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('interests')->insert([
            'name' => 'Sports',
        ]);
        DB::table('interests')->insert([
            'name' => 'Movies',
        ]);
        DB::table('interests')->insert([
            'name' => 'Reading',
        ]);
        DB::table('interests')->insert([
            'name' => 'Writing',
        ]);
        DB::table('interests')->insert([
            'name' => 'IOT',
        ]);
        DB::table('interests')->insert([
            'name' => 'Machine Learning',
        ]);
        DB::table('interests')->insert([
            'name' => 'Gaming',
        ]);
        DB::table('interests')->insert([
            'name' => 'Racing',
        ]);

    }
}
