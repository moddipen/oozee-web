<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('phone_number_id');
            $table->string('type')->default('manual')->comment('SignUp type eg. manual, google, facebook');
            $table->tinyInteger('status')->default(1)->comment('1 = active, 0 = suspend');
            $table->string('device_type')->comment('Android, IOS');
            $table->string('device_token');
            $table->string('device_imei');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('phone_number_id')->references('id')->on('phone_numbers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
