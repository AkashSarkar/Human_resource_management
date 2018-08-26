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
        $this->call(AccessSeeder::class);
        $this->call([
            EducationsSeeder::class,
            InterestsSeeder::class,
            ProfessionsSeeder::class,
            IndustriesSeeder::class,
            UserSeeder::class,
        ]);

    }
}
