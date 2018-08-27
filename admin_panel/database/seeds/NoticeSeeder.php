<?php

use Illuminate\Database\Seeder;

use Modules\Notice\Models\NoticeModel as model;
class NoticeSeeder extends Seeder
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
