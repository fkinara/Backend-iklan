<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Iklan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iklan', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('judul');
                $table->text('deskripsi');
                $table->double('harga');
                $table->string('gambar');
                $table->string('lokasi');
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
        Schema::dropIfExists('iklan');
    }
}
