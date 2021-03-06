<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBadgesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badge_user', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('badge_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('badge_id')->references('id')->on('badges');
            $table->foreign('user_id')->references('id')->on('patient_accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('badge_user');
    }
}
