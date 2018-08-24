<?php

use Illuminate\Database\Seeder;

class IndustriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('industries')->insert([
            'name' => 'Software',
            'connection_type_id' => 3,
        ]);

        DB::table('industries')->insert([
            'name' => 'Telecommunication',
            'connection_type_id' => 3,
        ]);

        DB::table('industries')->insert([
            'name' => 'Architecture',
            'connection_type_id' => 3,
        ]);

        DB::table('industries')->insert([
            'name' => 'Marketing',
            'connection_type_id' => 3,
        ]);

        DB::table('industries')->insert([
            'name' => 'Teaching',
            'connection_type_id' => 3,
        ]);

        DB::table('industries')->insert([
            'name' => 'Advertising',
            'connection_type_id' => 3,
        ]);

        DB::table('industries')->insert([
            'name' => 'Manufacturing',
            'connection_type_id' => 3,
        ]);

        DB::table('industries')->insert([
            'name' => 'Finace',
            'connection_type_id' => 3,
        ]);

        DB::table('industries')->insert([
            'name' => 'HR and Admin',
            'connection_type_id' => 3,
        ]);
    }
}
