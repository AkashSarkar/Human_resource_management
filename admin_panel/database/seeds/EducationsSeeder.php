<?php

use Illuminate\Database\Seeder;

class EducationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('educations')->insert([
            'name' => 'AUST',
        ]);

        DB::table('educations')->insert([
            'name' => 'UIU',
        ]);

        DB::table('educations')->insert([
            'name' => 'AIUB',
        ]);

        DB::table('educations')->insert([
            'name' => 'EWU',
        ]);

        DB::table('educations')->insert([
            'name' => 'BRAC',
        ]);

        DB::table('educations')->insert([
            'name' => 'NSU',
        ]);

        DB::table('educations')->insert([
            'name' => 'IUB',
        ]);
    }
}
