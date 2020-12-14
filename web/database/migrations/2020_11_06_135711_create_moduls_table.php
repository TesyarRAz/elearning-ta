<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moduls', function (Blueprint $table) {
            $table->id();

            $table->foreignId('guru_id')->constrained();
            $table->foreignId('pelajaran_id')->constrained();
            $table->string('kelas');

            $table->string('name');
            $table->text('keterangan');
            $table->string('password')->nullable();
            
            $table->text('gambar')->nullable();

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
        Schema::dropIfExists('moduls');
    }
}
