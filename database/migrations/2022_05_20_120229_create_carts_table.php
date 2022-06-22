<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('id_cart', 6)->unique();
            $table->string('id_barang', 6)->index();
            $table->string('id_lelang', 6)->index();
            $table->bigInteger('harga');
            $table->timestamp('batas_waktu_bayar');
            $table->timestamps();

            $table->foreign('id_barang')->references('id_barang')->on('products');
            $table->foreign('id_lelang')->references('id_lelang')->on('auctions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
