<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKategori extends Migration
{
  
    public function up()
    {
        Schema::create('table_kategori', function (Blueprint $table) {

            $table->bigIncrements('kategori');
            $table->string('deskripsi');
            $table->timestamps();
            
            });                
        }

    public function down()
    {
        Schema::dropIfExists('table_kategori');
    }
}
