<?php

use Illuminate\Database\Seeder;

use Modules\User\Models\EmployeeModel as model;

class EmployeeSeeder extends Seeder
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
