<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('tag', 50)->unique();
            $table->tinyInteger('perm')->default(0);
            $table->integer('_perm_sort')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
