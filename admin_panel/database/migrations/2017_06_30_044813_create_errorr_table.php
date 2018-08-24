<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErrorrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('errorr', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('source', ['back', 'front']);
            $table->text('message');
            $table->string('file_name');
            $table->string('function_name');
            $table->integer('line_number');
            $table->string('caller_file_name');
            $table->integer('caller_line_number');
            $table->decimal('memory', 10, 5);
            $table->decimal('seconds', 10, 5);
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
        Schema::dropIfExists('errorr', function (Blueprint $table) {
            //
        });
    }
}
