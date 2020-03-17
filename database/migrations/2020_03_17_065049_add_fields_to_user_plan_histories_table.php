<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUserPlanHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_plan_histories', function (Blueprint $table) {
            $table->string('order_id')->nullable();
            $table->timestamp('renew_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_plan_histories', function (Blueprint $table) {
            $table->dropColumn('order_id');
            $table->dropColumn('renew_date');
        });
    }
}
