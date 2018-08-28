<?php

use Illuminate\Database\Seeder;

use Modules\Department\Models\DepartmentModel as model;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(model::class,10)->create();
    }
}
