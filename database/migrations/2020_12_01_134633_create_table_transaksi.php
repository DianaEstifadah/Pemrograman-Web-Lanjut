<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTransaksi extends Migration
{

    public function up()
    {
        Schema::create('table_transaksi', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->integer('id_anggota');
            $table->integer('id_buku');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->timestamps();
            
            });    
         }

    public function down()
    {
        Schema::dropIfExists('table_transaksi');
    }
}
