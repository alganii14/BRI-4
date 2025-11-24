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
    public function up(): void
    {
        Schema::create('aum_dpks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_cabang_induk')->nullable();
            $table->string('cabang_induk')->nullable();
            $table->string('kode_uker')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->string('slp')->nullable();
            $table->string('pbo')->nullable();
            $table->string('cif')->nullable();
            $table->string('id_prioritas')->nullable();
            $table->string('nama_nasabah')->nullable();
            $table->string('nomor_rekening')->nullable();
            $table->string('aum')->nullable();
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
        Schema::dropIfExists('aum_dpks');
    }
};
