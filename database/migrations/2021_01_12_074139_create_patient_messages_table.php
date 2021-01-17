<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('score');
            $table->string('message',255);
            $table->boolean('is_solved');
            $table->string('solution',255)->nullable();
            $table->string('patient_accounts_username');
            $table->unsignedBigInteger('patient_profiles_id');
            //foreign key bind
            $table->foreign('patient_accounts_username')->references('username')->on('patient_accounts');
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
        Schema::dropIfExists('patient_messages');
    }
}
