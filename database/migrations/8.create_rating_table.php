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
        Schema::create('rating', function (Blueprint $table) {
            $table->id('id_rating');
            $table->unsignedBigInteger('id_antrian');
            $table->unsignedBigInteger('id_menu');            
            $table->integer('rating');
            $table->timestamps();

            $table->foreign('id_antrian')->references('id_antrian')->on('antrian');
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
        Schema::dropIfExists('rating');
    }
};
