<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonanKtpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonan_ktp', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('ttl');
            $table->char('jenis_kelamin', 11);
            $table->char('status', 11);
            $table->bigInteger('no_kk');
            $table->char('kewarganegaraan', 3);
            $table->string('agama');
            $table->string('pekerjaan');
            $table->text('alamat');
            $table->boolean('approve_rt')->default(false);
            $table->boolean('approve_rw')->default(false);
            $table->boolean('approve_kelurahan')->default(false);
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
        Schema::dropIfExists('permohonan_ktp');
    }
}
