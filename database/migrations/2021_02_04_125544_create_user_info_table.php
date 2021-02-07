<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_user_infos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->BigInteger('coin');
            $table->BigInteger('highscore');
            $table->BigInteger('avatars_id');
            $table->BigInteger('patient_accounts_id');
            $table->foreign('patient_accounts_id')->references('id')->on('patient_accounts');
            $table->foreign('avatars_id')->references('id')->on('avatars');
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
        Schema::dropIfExists('game_user_infos');
    }
}