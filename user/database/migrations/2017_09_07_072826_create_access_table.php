<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('access', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('perm_role_id')->nullable();
            $table->unsignedInteger('perm_module_id')->nullable();
            $table->tinyInteger('perm_view')->default(0);
            $table->tinyInteger('perm_add')->default(0);
            $table->tinyInteger('perm_edit')->default(0);
            $table->tinyInteger('perm_delete')->default(0);
            $table->tinyInteger('perm_all')->default(0);
            $table->timestamps();

            $table->index('perm_role_id');
            $table->index('perm_module_id');

            $table->foreign('perm_role_id')->references('id')->on('roles');
            $table->foreign('perm_module_id')->references('id')->on('modules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('access');
    }
}
