<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role_name' => 'User',
            'description' => 'User '
        ]);
        DB::table('roles')->insert([
            'role_name' => 'Guest',
            'description' => 'Guest '
        ]);
    }
}
