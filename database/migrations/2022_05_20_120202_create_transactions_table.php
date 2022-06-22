<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('id_transaksi', 6)->unique();
            $table->string('id_pemenang', 6);
            $table->string('id_barang', 6)->index();
            $table->string('id_pemilik', 6)->index();
            $table->string('id_cart', 6)->index();
            $table->bigInteger('harga');
            $table->bigInteger('jumlah_transaksi');
            $table->timestamps();

            $table->foreign('id_barang')->references('id_barang')->on('products');
            $table->foreign('id_pemilik')->references('id_pelelang')->on('products');
            // $table->foreign('id_cart')->references('id_cart')->on('carts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
