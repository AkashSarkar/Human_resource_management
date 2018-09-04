<?php

use Illuminate\Database\Seeder;

use Modules\User\Models\AccountModel as model;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(model::class,4)->create();
    }
}
