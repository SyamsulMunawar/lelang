<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->string('id_lelang', 6)->unique();
            $table->string('id_barang', 6)->index();
            $table->dateTime('waktu_buka_lelang');
            $table->dateTime('waktu_tutup_lelang');
            $table->integer('jumlah_tertarik')->default(0);
            $table->enum('status', ['menunggu', 'berlangsung', 'belum dibayar', 'terjual']);
            $table->timestamps();

            $table->foreign('id_barang')->references('id_barang')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auctions');
    }
}
