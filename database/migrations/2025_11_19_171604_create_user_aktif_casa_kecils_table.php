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
        Schema::create('user_aktif_casa_kecils', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kanca')->nullable();
            $table->string('kanca')->nullable();
            $table->string('kode_uker')->nullable();
            $table->string('uker')->nullable();
            $table->string('nama_nasabah')->nullable();
            $table->string('cifno')->nullable();
            $table->string('norek_pinjaman')->nullable();
            $table->string('saldo_bulan_lalu')->nullable();
            $table->string('saldo_bulan_berjalan')->nullable();
            $table->string('delta_saldo')->nullable();
            $table->string('nama_rm_pemrakarsa')->nullable();
            $table->string('qcash')->nullable();
            $table->string('qib')->nullable();
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
        Schema::dropIfExists('user_aktif_casa_kecils');
    }
};
