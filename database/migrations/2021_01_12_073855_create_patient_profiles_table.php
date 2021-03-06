<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_profiles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('first_name', 255);
            $table->string('last_name',255);
            $table->string('ic_number',12)->unique();
            $table->string('gender',1);
            $table->unsignedInteger('age');
            $table->string('cancer',255);
            $table->unsignedBigInteger('user_profiles_id');
            //soft deletes
            $table->softDeletes();
            //foreign key bind
            $table->foreign('user_profiles_id')->references('id')->on('user_profiles');
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
        Schema::dropIfExists('patient_profiles');
    }
}
