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
            'name' => 'Expense',
            'tag' => 'expense'
        ]);
        DB::table('modules')->insert([
            'name' => 'Notice',
            'tag' => 'notice'
        ]);
        DB::table('modules')->insert([
            'name' => 'Department',
            'tag' => 'department'
        ]);
        DB::table('modules')->insert([
            'name' => 'Employee',
            'tag' => 'employee'
        ]);
        DB::table('modules')->insert([
            'name' => 'Position',
            'tag' => 'position'
        ]);
        DB::table('modules')->insert([
            'name' => 'Account',
            'tag' => 'account'
        ]);

    }
}
