<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePatientTableV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient', function (Blueprint $table) {
            $table->string('patient_id')->nullable()->after('id');
            $table->date('book_date')->nullable()->after('register_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient', function (Blueprint $table) {
            //
        });
    }
}
