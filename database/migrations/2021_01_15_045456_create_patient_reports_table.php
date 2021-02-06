<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_reports', function (Blueprint $table) {
            $table->id();
            $table->string('body_part');
            $table->unsignedBigInteger('level');
            $table->string('description');
            $table->unsignedBigInteger('duration');
            $table->unsignedBigInteger('mood');
            $table->unsignedBigInteger('patient_accounts_id');
            $table->unsignedBigInteger('patient_profiles_id');
            //foreign key bind
            $table->foreign('patient_accounts_id')->references('id')->on('patient_accounts');
            $table->foreign('patient_profiles_id')->references('id')->on('patient_profiles');
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
        Schema::dropIfExists('patient_reports');
    }
}
