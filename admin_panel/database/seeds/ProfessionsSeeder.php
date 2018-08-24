<?php

use Illuminate\Database\Seeder;

class ProfessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('professions')->insert([
            'name' => 'Engineer',
            'connection_type_id' => 2,
        ]);
        DB::table('professions')->insert([
            'name' => 'Developer',
            'connection_type_id' => 2,
        ]);
        DB::table('professions')->insert([
            'name' => 'Executive',
            'connection_type_id' => 2,
        ]);
        DB::table('professions')->insert([
            'name' => 'Writer',
            'connection_type_id' => 2,
        ]);
        DB::table('professions')->insert([
            'name' => 'Teacher',
            'connection_type_id' => 2,
        ]);
        DB::table('professions')->insert([
            'name' => 'Director',
            'connection_type_id' => 2,
        ]);
        DB::table('professions')->insert([
            'name' => 'HR Professionals',
            'connection_type_id' => 2,
        ]);

        DB::table('professions')->insert([
            'name' => 'Lawyer',
            'connection_type_id' => 2,
        ]);
    }
}
