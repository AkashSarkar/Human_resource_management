<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('menus')->insert([
            'id' => 1,
            'uri_name' => 'home',
            'url' => 'home',
            'label' => 'Dashboard',
            '_parent_id' => '0',
            '_sort' => '1',
        ]);

        DB::table('menus')->insert([
            'id' => 2,
            'uri_name' => '',
            'url' => '',
            'label' => 'Employees',
            '_parent_id' => '0',
            '_sort' => '2',
        ]);
        DB::table('menus')->insert([
            'id' => 3,
            'uri_name' => 'employee',
            'url' => 'employee',
            'label' => 'Employees Information',
            '_parent_id' => '2',
            '_sort' => '1',
        ]);
        DB::table('menus')->insert([
            'id' => 4,
            'uri_name' => 'position',
            'url' => 'position',
            'label' => 'Employees Position',
            '_parent_id' => '2',
            '_sort' => '1',
        ]);
        DB::table('menus')->insert([
            'id' => 5,
            'uri_name' => 'account',
            'url' => 'account',
            'label' => 'Employees account',
            '_parent_id' => '2',
            '_sort' => '2',
        ]);

        DB::table('menus')->insert([
            'id' => 6,
            'uri_name' => 'expense',
            'url' => 'expense',
            'label' => 'Expense',
            '_parent_id' => '0',
            '_sort' => '3',
        ]);
        DB::table('menus')->insert([
            'id' => 7,
            'uri_name' => 'department',
            'url' => 'department',
            'label' => 'Department',
            '_parent_id' => '0',
            '_sort' => '3',
        ]);
        DB::table('menus')->insert([
            'id' => 8,
            'uri_name' => 'notice',
            'url' => 'notice',
            'label' => 'Notice',
            '_parent_id' => '0',
            '_sort' => '3',
        ]);

    }
}
