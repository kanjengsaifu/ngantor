<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_keluar', function (Blueprint $table) {
            $table->increments('id');
			$table->string('nomor')->unique();
			$table->string('tgl');
			$table->integer('id_sifat')->unsigned();
			$table->string('perihal');
			$table->integer('id_user')->unsigned();
            $table->timestamps();

			$table->foreign('id_sifat')->references('id')->on('ms_sifat');
			$table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ms_keluar');
    }
}
