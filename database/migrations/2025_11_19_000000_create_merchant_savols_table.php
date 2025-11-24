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
        Schema::create('merchant_savols', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kanca')->nullable();
            $table->string('kanca')->nullable();
            $table->string('kode_uker')->nullable();
            $table->string('uker')->nullable();
            $table->string('jenis_merchant')->nullable();
            $table->string('tid_store_id')->nullable();
            $table->string('nama_merchant')->nullable();
            $table->text('alamat_merchant')->nullable();
            $table->string('norekening')->nullable();
            $table->string('cif')->nullable();
            $table->string('savol_bulan_lalu')->nullable();
            $table->string('casa_akhir_bulan')->nullable();
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
        Schema::dropIfExists('merchant_savols');
    }
};
