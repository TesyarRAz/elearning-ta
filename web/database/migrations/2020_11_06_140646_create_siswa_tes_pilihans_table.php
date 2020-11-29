<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTesPilihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa_tes_pilihans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_tes_id')->constrained();

            $table->foreignId('soal_id')->constrained();
            $table->foreignId('pilihan_id')->nullable()->constrained();
            
            $table->boolean('benar')->default(false);
            $table->boolean('tandai')->default(false);

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
        Schema::dropIfExists('siswa_tes_pilihans');
    }
}
