<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonanKkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonan_kk', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->default('');
            $table->string('ttl')->default('');
            $table->char('jenis_kelamin', 11)->default('');
            $table->char('status', 11)->default('');
            $table->bigInteger('no_ktp')->nullable();
            $table->char('kewarganegaraan', 3)->default('');
            $table->string('agama')->default('');
            $table->string('pekerjaan')->default('');
            $table->text('alamat')->default('');
            $table->text('foto_suami');
            $table->text('foto_istri');
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
        Schema::dropIfExists('permohonan_kk');
    }
}
