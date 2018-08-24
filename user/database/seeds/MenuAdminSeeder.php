<?php

use Illuminate\Database\Seeder;

class MenuAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('menus_admin')->insert([
            'id' => 1,
            'uri_name' => 'home',
            'url' => 'home',
            'label' => 'Dashboard',
            '_parent_id' => '0',
            '_sort' => '1',
        ]);

        DB::table('menus_admin')->insert([
            'id' => 2,
            'uri_name' => '',
            'url' => '',
            'label' => 'Place Holders',
            '_parent_id' => '0',
            '_sort' => '2',
        ]);
        DB::table('menus_admin')->insert([
            'id' => 3,
            'uri_name' => 'industry',
            'url' => 'industry',
            'label' => 'Industry',
            '_parent_id' => '2',
            '_sort' => '1',
        ]);
        DB::table('menus_admin')->insert([
            'id' => 4,
            'uri_name' => 'interest',
            'url' => 'interest',
            'label' => 'Interest',
            '_parent_id' => '2',
            '_sort' => '1',
        ]);
        DB::table('menus_admin')->insert([
            'id' => 5,
            'uri_name' => 'profession',
            'url' => 'profession',
            'label' => 'Profession',
            '_parent_id' => '2',
            '_sort' => '2',
        ]);
        DB::table('menus_admin')->insert([
            'id' => 6,
            'uri_name' => 'education',
            'url' => 'education',
            'label' => 'Education',
            '_parent_id' => '2',
            '_sort' => '3',
        ]);
        DB::table('menus_admin')->insert([
            'id' => 7,
            'uri_name' => 'company',
            'url' => 'company',
            'label' => 'Company',
            '_parent_id' => '2',
            '_sort' => '4',
        ]);
        DB::table('menus_admin')->insert([
            'id' => 8,
            'uri_name' => 'user',
            'url' => 'user',
            'label' => 'User',
            '_parent_id' => '0',
            '_sort' => '3',
        ]);

    }
}
