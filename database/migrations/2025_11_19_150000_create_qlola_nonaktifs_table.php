<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('qlola_nonaktifs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kanca')->nullable();
            $table->string('kanca')->nullable();
            $table->string('kode_uker')->nullable();
            $table->string('uker')->nullable();
            $table->string('cifno')->nullable();
            $table->string('norek_pinjaman')->nullable();
            $table->string('norek_simpanan')->nullable();
            $table->string('nama_debitur')->nullable();
            $table->string('plafon')->nullable();
            $table->string('pn_pengelola')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qlola_nonaktifs');
    }
};
