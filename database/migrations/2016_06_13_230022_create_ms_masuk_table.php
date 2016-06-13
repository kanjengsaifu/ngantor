<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_masuk', function (Blueprint $table) {
            $table->increments('id');
			$table->string('nomor')->unique();
			$table->integer('id_sifat')->unsigned();
			$table->string('perihal');
			$table->string('asal');
			$table->integer('id_status')->unsigned();
			$table->integer('id_user')->unsigned();
            $table->timestamps();

			$table->foreign('id_sifat')->references('id')->on('ms_sifat');
			$table->foreign('id_status')->references('id')->on('ms_status');
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
        Schema::drop('ms_masuk');
    }
}
