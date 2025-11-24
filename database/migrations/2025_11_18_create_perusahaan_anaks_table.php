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
        Schema::create('perusahaan_anaks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_partner_vendor')->nullable();
            $table->string('jenis_usaha')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kode_cabang_induk')->nullable();
            $table->string('cabang_induk_terdekat')->nullable();
            $table->string('nama_pic_partner')->nullable();
            $table->string('posisi_pic_partner')->nullable();
            $table->string('hp_pic_partner')->nullable();
            $table->string('nama_perusahaan_anak')->nullable();
            $table->string('status_pipeline')->nullable();
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
        Schema::dropIfExists('perusahaan_anaks');
    }
};
