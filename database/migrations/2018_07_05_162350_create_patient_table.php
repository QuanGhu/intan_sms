<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone_number');
            $table->string('name');
            $table->unsignedInteger('queue_no');
            $table->string('queue_code');
            $table->dateTime('register_time');
            $table->unsignedInteger('poli_id')->nullable();
            $table->timestamps();

            $table->foreign('poli_id')->references('id')->on('poli')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient');
    }
}
