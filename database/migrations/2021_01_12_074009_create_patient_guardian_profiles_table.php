<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientGuardianProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_guardian_profiles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('first_name', 255);
            $table->string('last_name',255);
            $table->string('ic_number',12)->unique();
            $table->string('relations',255);
            $table->string('contact',11);
            $table->string('address_one',255);
            $table->string('address_two',255);
            $table->string('postcode',5);
            $table->string('state',255);
            $table->string('city',255);
            $table->unsignedBigInteger('patient_profiles_id');
            //foreign key bind
            $table->foreign('patient_profiles_id')->references('id')->on('patient_profiles')->onDelete('cascade');
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
        Schema::dropIfExists('patient_guardian_profiles');
    }
}
