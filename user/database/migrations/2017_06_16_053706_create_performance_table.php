<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('performance');
        Schema::create('performance', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('source', ['back', 'front']);

            $table->text("full_url");
            $table->integer("query_number");
            $table->text("get");
            $table->text("post");


            $table->string('function_name');
            $table->string('caller_file_name');
            $table->integer('caller_line_number');
            $table->decimal('memory', 10, 5);
            $table->decimal('seconds', 10, 5);

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
        Schema::drop('performance');
    }
}
