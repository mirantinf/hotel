<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipeKamarsBarangKamarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipe_kamars_barang_kamars', function (Blueprint $table) {
            $table->unsignedBigInteger('tipe_kamar_id');
            $table->foreign('tipe_kamar_id')->references('id')->on('tipe_kamars')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('barang_kamar_id');
            $table->foreign('barang_kamar_id')->references('id')->on('barang_kamars')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipe_kamars_barang_kamars');
    }
}
