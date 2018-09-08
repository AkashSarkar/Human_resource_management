<?php

use Illuminate\Database\Seeder;

class LeaveTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('pgsql_user')->table('leave_types')->insert([
            'name'=>'Unpaid'
        ]);
        DB::connection('pgsql_user')->table('leave_types')->insert([
            'name'=>'Sick'
        ]);
        DB::connection('pgsql_user')->table('leave_types')->insert([
            'name'=>'Maternity'
        ]);
        DB::connection('pgsql_user')->table('leave_types')->insert([
            'name'=>'Half day'
        ]);
        DB::connection('pgsql_user')->table('leave_types')->insert([
            'name'=>'Others'
        ]);

    }
}
