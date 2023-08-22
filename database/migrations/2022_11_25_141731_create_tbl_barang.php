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
        Schema::create('tbl_barang', function (Blueprint $table) {
            $table->increments('barang_id');
            $table->string('jenisbarang_id')->nullable();
            $table->string('satuan_id')->nullable();
            $table->string('merk_id')->nullable();
            $table->string('barang_kode');
            $table->string('barang_nama');
            $table->string('barang_slug');
            $table->string('barang_harga');
            $table->string('barang_stok');
            $table->string('barang_gambar');
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
        Schema::dropIfExists('tbl_barang');
    }
};
