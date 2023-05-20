<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('no_transaksi', 15);
            $table->uuid('id_menu');
            $table->integer('qty');
            $table->string('no_kamar');
            $table->string('nama_customer');
            $table->string('total_harga');
            $table->enum('status', ['Disajikan', 'Selesai'])->default('Disajikan');
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
        Schema::dropIfExists('transaksi');
    }
}
