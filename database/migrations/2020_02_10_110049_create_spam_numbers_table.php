<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpamNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spam_numbers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('number');
            $table->tinyInteger('spam_by')->default(0)->comment("0 = admin, 1 = user");
            $table->integer('counts')->default(1);
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
        Schema::dropIfExists('spam_numbers');
    }
}
