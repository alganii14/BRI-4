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
        Schema::create('potensi_payrolls', function (Blueprint $table) {
            $table->id();
            $table->string('no')->nullable();
            $table->string('kode_cabang_induk')->nullable();
            $table->string('cabang_induk')->nullable();
            $table->string('perusahaan')->nullable();
            $table->string('estimasi_pekerja')->nullable();
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
        Schema::dropIfExists('potensi_payrolls');
    }
};
