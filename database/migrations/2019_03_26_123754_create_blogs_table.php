<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('blogs');

        Schema::create('blogs', function (Blueprint $table) {
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
            'DROP PROCEDURE IF EXISTS `select_blog_by_id`;
            CREATE PROCEDURE `select_blog_by_id` (IN idx int)
            BEGIN
                SELECT * FROM blogs WHERE id = idx;
            END
        ');
        DB::unprepared(
            'DROP PROCEDURE IF EXISTS `select_blogs`;
            CREATE PROCEDURE `select_blogs` ()
            BEGIN
                SELECT * FROM blogs;
            END
        ');
        DB::unprepared(
            'DROP PROCEDURE IF EXISTS `select_blog_by_slug`;
            CREATE PROCEDURE `select_blog_by_slug` (IN slugx varchar)
            BEGIN
                SELECT * FROM blogs WHERE slug = slugx;
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
        Schema::dropIfExists('blogs');
    }
}
