<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRtIdAndRwIdToPermohonanKtpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permohonan_ktp', function (Blueprint $table) {
            $table->bigInteger('rt_id')->after('user_id')->default(0);
            $table->bigInteger('rw_id')->after('rt_id')->default(0);
        });

        Schema::table('permohonan_kk', function (Blueprint $table) {
            $table->bigInteger('rt_id')->after('user_id')->default(0);
            $table->bigInteger('rw_id')->after('rt_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permohonan_ktp', function (Blueprint $table) {
            $table->dropColumn('rt_id');
            $table->dropColumn('rw_id');
        });

        Schema::table('permohonan_ktp', function (Blueprint $table) {
            $table->dropColumn('rt_id');
            $table->dropColumn('rw_id');
        });
    }
}
