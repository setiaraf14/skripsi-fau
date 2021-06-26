<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToPermohonanKtpAndPermohonanKkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permohonan_ktp', function (Blueprint $table) {
            $table->bigInteger('user_id')->after('id')->default(0);
        });

        Schema::table('permohonan_kk', function (Blueprint $table) {
            $table->bigInteger('user_id')->after('id')->default(0);
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
            $table->dropColumn('user_id');
        });

        Schema::table('permohonan_kk', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
