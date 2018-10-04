<?php

use Illuminate\Database\Seeder;

use Modules\Holiday\Models\HolidayModel as model;
class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(model::class,20)->create();
    }
}
