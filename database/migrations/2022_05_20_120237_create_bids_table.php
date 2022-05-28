<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->string('id_tawaran', 6)->unique();
            $table->string('id_lelang', 6)->index();
            $table->string('id_peserta', 6)->index();
            $table->string('id_barang', 6)->index();
            $table->bigInteger('jumlah_tawaran');
            $table->timestamp('waktu_tawar');
            $table->timestamps();

            $table->foreign('id_lelang')->references('id_lelang')->on('auctions');
            $table->foreign('id_peserta')->references('id_user')->on('users');
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
        Schema::dropIfExists('bids');
    }
}
