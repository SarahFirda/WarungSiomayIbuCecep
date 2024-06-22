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
        Schema::create('pesanan_detail', function (Blueprint $table) {
            $table->id('id_pesanan_detail');
            $table->unsignedBigInteger('id_pesanan');
            $table->unsignedBigInteger('id_menu');
            $table->integer('jumlah_menu');
            $table->string('add_on');
            $table->string('catatan')->nullable();
            $table->integer('harga_satuan');
            $table->timestamps();

            $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanan');
            $table->foreign('id_menu')->references('id_menu')->on('menu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan_detail');
    }
};
