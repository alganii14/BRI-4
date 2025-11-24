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
        Schema::create('rekaps', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kc')->nullable();
            $table->string('pn')->nullable();
            $table->string('nama_rmft')->nullable();
            $table->string('nama_pemilik')->nullable();
            $table->string('no_rekening')->nullable();
            $table->decimal('pipeline', 20, 2)->default(0);
            $table->decimal('realisasi', 20, 2)->default(0);
            $table->text('keterangan')->nullable();
            $table->string('validasi')->nullable();
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
        Schema::dropIfExists('rekaps');
    }
};
