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
            'role_name' => 'Admin',
            'description' => 'Admin '
        ]);
        DB::table('roles')->insert([
            'role_name' => 'Sub Admin',
            'description' => 'Sub Admin '
        ]);
    }
}
