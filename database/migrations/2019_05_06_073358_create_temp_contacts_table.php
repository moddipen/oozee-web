<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id');
            $table->integer('country_id');
            $table->bigInteger('phone_number');
            $table->string('first_name')->default('');
            $table->string('last_name')->default('');
            $table->string('email')->default('');
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
        Schema::dropIfExists('temp_contacts');
    }
}
