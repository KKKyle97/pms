<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvatarsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avatar_user', function (Blueprint $table) {
            $table->integer('avatar_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->boolean('is_selected');
            $table->foreign('avatar_id')->references('id')->on('avatars');
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
        Schema::dropIfExists('avatar_user');
    }
}
