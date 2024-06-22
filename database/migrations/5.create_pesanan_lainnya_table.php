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
        Schema::create('pesanan_lainnya', function (Blueprint $table) {
            $table->id('id_pesanan_lainnya');
            $table->integer('nominal_lainnya');
            $table->string('sumber_lainnya');
            $table->date('tanggal_lainnya');
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
        Schema::dropIfExists('pesanan_lainnya');
    }
};
