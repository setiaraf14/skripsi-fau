<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRtRwRoleToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('rt_id')->unsigned()->nullable()->after('name');
            $table->bigInteger('rw_id')->unsigned()->nullable()->after('rt_id');
            $table->bigInteger('role_user_id')->unsigned()->nullable()->after('rw_id');

            $table->foreign('rt_id')->references('id')->on('rts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('rw_id')->references('id')->on('rws')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('role_user_id')->references('id')->on('role-user')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rt_id');
            $table->dropColumn('rw_id');
            $table->dropColumn('role_id');
        });
    }
}
