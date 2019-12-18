<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateStoreProceduresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Admin Users SP
         */
        DB::unprepared(
            'DROP PROCEDURE IF EXISTS `select_admin_user_by_id`;
            CREATE PROCEDURE `select_admin_user_by_id` (IN idx int)
            BEGIN
                SELECT * FROM admin_users WHERE id = idx AND deleted_at IS NULL;
            END'
        );
        DB::unprepared(
            'DROP PROCEDURE IF EXISTS `select_admin_users`;
            CREATE PROCEDURE select_admin_users()
            BEGIN
                SELECT * FROM admin_users WHERE deleted_at IS NULL;
            END'
        );
        DB::unprepared(
            'DROP PROCEDURE IF EXISTS `select_admin_users_except_current`;
            CREATE PROCEDURE `select_admin_users_except_current` (IN idx int)
            BEGIN
                SELECT * FROM admin_users where id != idx AND deleted_at IS NULL;
            END'
        );


        /**
         * Permissions SP
         */
        DB::unprepared(
            'DROP PROCEDURE IF EXISTS `select_permission_by_id`;
            CREATE PROCEDURE `select_permission_by_id` (IN idx int)
            BEGIN
                SELECT * FROM permissions WHERE id = idx;
            END'
        );
        DB::unprepared(
            'DROP PROCEDURE IF EXISTS `select_permissions`;
            CREATE PROCEDURE select_permissions()
            BEGIN
                SELECT * FROM permissions;
            END'
        );

        /**
         * Roles SP
         */
        DB::unprepared(
            'DROP PROCEDURE IF EXISTS `select_role_by_id`;
            CREATE PROCEDURE `select_role_by_id` (IN idx int)
            BEGIN
                SELECT * FROM roles WHERE id = idx;
            END'
        );

        DB::unprepared(
            'DROP PROCEDURE IF EXISTS `select_roles`;
            CREATE PROCEDURE select_roles()
            BEGIN
                SELECT * FROM roles;
            END'
        );

        /**
         * Application users SP
         **/
        DB::unprepared(
            'DROP PROCEDURE IF EXISTS `select_user_by_id`;
            CREATE PROCEDURE `select_user_by_id` (IN idx int)
            BEGIN
                SELECT * FROM users WHERE id = idx AND deleted_at NULL;
            END
        ');
        DB::unprepared(
            'DROP PROCEDURE IF EXISTS `select_users`;
            CREATE PROCEDURE `select_users` ()
            BEGIN
                SELECT * FROM users WHERE deleted_at NULL;
            END
        ');
        DB::unprepared(
            'DROP PROCEDURE IF EXISTS `select_user_by_number`;
            CREATE PROCEDURE `select_user_by_number` (IN numberx int)
            BEGIN
                SELECT * FROM users WHERE number deleted_at NULL;
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
        Schema::dropIfExists('store_procedures');
    }
}
