<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_lelan', function (Blueprint $table) {
            $table->bigIncrements('id_history');
            $table->integer('id_lelang')->nullable();
            $table->integer('id_barang')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('penawaran_harga')->nullable();
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
        Schema::dropIfExists('users');
    }
}
