<?php

use Illuminate\Database\Seeder;

use Modules\Expense\Models\ExpenseModel as Expense;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Expense::class,10)->create();
    }
}
