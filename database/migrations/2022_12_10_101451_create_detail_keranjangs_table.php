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
        Schema::create('detail_keranjangs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_varian')->unsigned();
            $table->bigInteger('id_keranjang')->unsigned();
            $table->integer('jumlah');
            $table->foreign('id_varian')->references('id_variant')->on('variants')->onDelete('cascade');
            $table->foreign('id_keranjang')->references('id_keranjang')->on('keranjangs')->onDelete('cascade');

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
        Schema::dropIfExists('detail_keranjangs');
    }
};
