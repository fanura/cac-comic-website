<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profil', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('nama_karakter');
            $table->text('slug');
            $table->string('nama_asli');
            $table->integer('karakter_id');
            $table->string('asal');
            $table->string('tinggi');
            $table->string('berat');
            $table->text('kemampuan');
            $table->text('latar_belakang');
            $table->string('gambar_karakter');
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
        Schema::dropIfExists('profil');
    }
}
