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
        Schema::create('penurunan_prioritas_ritel_mikro', function (Blueprint $table) {
            $table->id();
            $table->string('kode_cabang_induk')->nullable();
            $table->string('cabang_induk')->nullable();
            $table->string('kode_uker')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->string('cifno')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('nama_nasabah')->nullable();
            $table->string('segmentasi_bpr')->nullable();
            $table->string('jenis_simpanan')->nullable();
            $table->decimal('saldo_last_eom', 20, 2)->nullable();
            $table->decimal('saldo_terupdate', 20, 2)->nullable();
            $table->decimal('delta', 20, 2)->nullable();
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
        Schema::dropIfExists('penurunan_prioritas_ritel_mikro');
    }
};
