<?php

use Illuminate\Database\Seeder;

use Modules\Award\Models\AwardModel as model;
class AwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(model::class,3)->create();
    }
}
