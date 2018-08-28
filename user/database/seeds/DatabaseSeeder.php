<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MenuSeeder::class);
        $this->call(ModulesSeeder::class);
        $this->call(RolesTableSeeder::class);
//        $this->call([
//            UserSeeder::class,
//            ExpenseSeeder::class,
//            NoticeSeeder::class,
//            DepartmentSeeder::class,
//        ]);

    }
}
