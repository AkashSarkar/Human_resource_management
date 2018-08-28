<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_acs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ac_name');
            $table->string('ac_number');
            $table->string('bank');
            $table->string('ifsc');
            $table->string('pan');
            $table->string('branch');
            $table->integer('user_id');
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
        Schema::dropIfExists('bank_ac');
    }
}
