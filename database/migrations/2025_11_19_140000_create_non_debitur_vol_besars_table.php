<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNonDebiturVolBesarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('non_debitur_vol_besars', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kanca')->nullable();
            $table->string('kanca')->nullable();
            $table->string('kode_uker')->nullable();
            $table->string('uker')->nullable();
            $table->string('cifno')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('nama_nasabah')->nullable();
            $table->string('segmentasi')->nullable();
            $table->string('vol_qcash')->nullable();
            $table->string('vol_qib')->nullable();
            $table->string('saldo')->nullable();
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
        Schema::dropIfExists('non_debitur_vol_besars');
    }
}
