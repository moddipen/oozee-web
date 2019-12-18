<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoiceMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voice_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('sender_user_id');
            $table->unsignedBigInteger('receiver_user_id');
            $table->timestamps();
            $table->foreign('sender_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voice_messages');
    }
}
