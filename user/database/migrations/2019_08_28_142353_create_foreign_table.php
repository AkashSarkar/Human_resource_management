<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users');
            $table->foreign('department_id')
                ->references('id')->on('departments');

        });

        Schema::table('bank_acs', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users');
        });

        Schema::table('awards', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users');
        });

        Schema::table('attendances', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users');
        });
        Schema::table('leaves', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users');
            $table->foreign('l_type_id')
                ->references('id')->on('leave_types');
            $table->foreign('a_id')
                ->references('id')->on('actions');
        });
//        Schema::table('access', function (Blueprint $table) {
//            $table->foreign('perm_role_id')
//                ->references('id')->on('roles');
//            $table->foreign('perm_module_id')
//                ->references('id')->on('modules');
//
//        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('access', function (Blueprint $table) {
//            $table->dropForeign([
//                'perm_role_id'
//            ]);
//            $table->dropForeign([
//                'perm_module_id'
//            ]);
//        });
        Schema::table('leaves', function (Blueprint $table) {
            $table->dropForeign([
                'user_id'
            ]);
            $table->dropForeign([
                'l_type_id'
            ]);
            $table->dropForeign([
                'a_id'
            ]);
        });
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign([
                'user_id'
            ]);
        });
        Schema::table('awards', function (Blueprint $table) {
            $table->dropForeign([
                'user_id'
            ]);
        });

        Schema::table('bank_acs', function (Blueprint $table) {
            $table->dropForeign([
                'user_id'
            ]);
        });
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign([
                'user_id'
            ]);
            $table->dropForeign([
                'department_id'
            ]);
        });
    }
}
