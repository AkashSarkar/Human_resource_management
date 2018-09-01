<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::connection('pgsql_front')->create('user_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string("label");
            $table->string("uri_name");
            $table->string("url");
            $table->integer("_parent_id");
            $table->integer("_sort")->default(0);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('user_menus');
    }
}
