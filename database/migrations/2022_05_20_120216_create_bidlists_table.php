<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bidlists', function (Blueprint $table) {
            $table->id();
            $table->string('id_peserta', 6)->index();
            $table->string('id_barang', 6)->unique()->index();
            $table->string('id_lelang', 6)->index();
            $table->timestamps();

            $table->foreign('id_barang')->references('id_barang')->on('products');
            $table->foreign('id_peserta')->references('id_user')->on('users');
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
        Schema::dropIfExists('bidlists');
    }
}
