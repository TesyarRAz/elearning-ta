<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modul_id')->constrained();
            $table->foreignId('bank_soal_id')->constrained();

            $table->string('name');
            $table->longText('keterangan');

            $table->integer('total_soal');
            $table->integer('waktu_pengerjaan');

            $table->enum('type', ['one_used', 're_used'])->default('one_used');
            $table->string('password')->nullable();

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
        Schema::dropIfExists('tes');
    }
}
