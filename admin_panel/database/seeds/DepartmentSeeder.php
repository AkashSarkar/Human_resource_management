<?php

use Illuminate\Database\Seeder;

use Modules\Notice\Models\NoticeModel as Notice;

class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Notice::class,10)->create();
    }
}
