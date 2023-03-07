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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id_orders');
            $table->bigInteger('id_keranjang')->unsigned();
            $table->string('tanggal');
            $table->string('resi_Pengiriman');
            $table->integer('subtotal');
            $table->integer('total_harga');
            $table->text('gambar');
            $table->string('status');
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
        Schema::dropIfExists('orders');
    }
};
