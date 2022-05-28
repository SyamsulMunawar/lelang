<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('id_barang', 6)->unique();
            $table->string('id_pelelang', 6)->index();
            $table->string('nama_barang');
            $table->enum('kategori', ['Kemeja', 'Kaos', 'Celana Panjang', 'Celana Pendek', 'Rok', 'Topi', 'Hijab', 'Jaket', 'Sweater', 'Sepatu/Sandal']);
            $table->string('ukuran');
            $table->string('image');
            $table->bigInteger('harga_awal'); 
            $table->text('deskripsi');
            $table->enum('status', ['Belum dilelang', 'Telah Dilelang', 'Belum dibayar']);
            $table->timestamps();

            $table->foreign('id_pelelang')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
