<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('email')->default('');
            $table->string('first_name')->default('');
            $table->string('last_name')->default('');
            $table->string('nick_name')->default('');
            $table->string('gender')->default('');
            $table->string('about')->default('');
            $table->string('address')->default('');
            $table->string('website')->default('');
            $table->string('industry')->default('');
            $table->string('company_name')->default('');
            $table->string('company_address')->default('');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}
