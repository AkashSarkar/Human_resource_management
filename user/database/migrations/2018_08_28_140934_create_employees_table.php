<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->text('f_name');
            $table->text('gender');
            $table->string('phone');
            $table->date('dob')->nullable();
            $table->longText('p_address');
            $table->longText('l_address');
            $table->unsignedInteger('role_id')->nullable();
            $table->index('role_id');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
