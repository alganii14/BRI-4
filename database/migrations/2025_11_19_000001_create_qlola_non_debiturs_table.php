<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qlola_non_debiturs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kanca')->nullable();
            $table->string('kanca')->nullable();
            $table->string('kode_uker')->nullable();
            $table->string('uker')->nullable();
            $table->string('cifno')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('nama_nasabah')->nullable();
            $table->string('segmentasi')->nullable();
            $table->string('cek_qcash')->nullable();
            $table->string('cek_cms')->nullable();
            $table->string('cek_ib')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('qlola_non_debiturs');
    }
};
