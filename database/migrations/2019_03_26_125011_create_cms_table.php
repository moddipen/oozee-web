<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('cms');

        Schema::create('cms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('content');
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by')->unsigned();
            $table->timestamps();
        });

        /**
         * SP
         **/
        DB::unprepared(
            'DROP PROCEDURE IF EXISTS `select_cms_by_id`;
            CREATE PROCEDURE `select_cms_by_id` (IN idx int)
            BEGIN
                SELECT * FROM cms WHERE id = idx;
            END
        ');
        DB::unprepared(
            'DROP PROCEDURE IF EXISTS `select_cms`;
            CREATE PROCEDURE `select_cms` ()
            BEGIN
                SELECT * FROM cms;
            END
        ');
        DB::unprepared(
            'DROP PROCEDURE IF EXISTS `select_cms_by_slug`;
            CREATE PROCEDURE `select_cms_by_slug` (IN slugx varchar)
            BEGIN
                SELECT * FROM cms WHERE slug = slugx;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms');
    }
}
