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

        DB::table('menus')->insert([
            'id' => 9,
            'uri_name' => '',
            'url' => '',
            'label' => 'Attendance',
            '_parent_id' => '0',
            '_sort' => '2',
        ]);
        DB::table('menus')->insert([
            'id' => 10,
            'uri_name' => 'attendance',
            'url' => 'attendance',
            'label' => 'Mark Attendance',
            '_parent_id' => '9',
            '_sort' => '2',
        ]);
//        DB::table('menus')->insert([
//            'id' => 11,
//            'uri_name' => 'view',
//            'url' => 'view',
//            'label' => 'View Attendance',
//            '_parent_id' => '9',
//            '_sort' => '2',
//        ]);
        DB::table('menus')->insert([
            'id' => 12,
            'uri_name' => 'leave',
            'url' => 'leave',
            'label' => 'Leave Types',
            '_parent_id' => '9',
            '_sort' => '2',
        ]);

        DB::table('menus')->insert([
            'id' => 13,
            'uri_name' => 'award',
            'url' => 'award',
            'label' => 'Awards',
            '_parent_id' => '0',
            '_sort' => '3',
        ]);
        DB::table('menus')->insert([
            'id' => 14,
            'uri_name' => 'holiday',
            'url' => 'holiday',
            'label' => 'Holidays',
            '_parent_id' => '0',
            '_sort' => '3',
        ]);
        DB::table('menus')->insert([
            'id' => 15,
            'uri_name' => 'application',
            'url' => 'application',
            'label' => 'Leave applications',
            '_parent_id' => '0',
            '_sort' => '3',
        ]);


    }
}
