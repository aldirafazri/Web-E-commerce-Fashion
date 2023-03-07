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
        Schema::create('history_variants', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_admin')->unsigned();
            $table->bigInteger('id_variant')->unsigned();
            $table->integer('stok_lama');
            $table->integer('stok_baru');
            $table->foreign('id_admin')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_variant')->references('id_variant')->on('variants')->onDelete('cascade');
            $table->string('waktu');
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
        Schema::dropIfExists('history_variants');
    }
};
