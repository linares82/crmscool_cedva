<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHsSeguimientosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hs_seguimientos', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('seguimiento_id')->unsigned();
            $table->integer('cliente_id')->unsigned();
            $table->integer('st_seguimiento_id')->unsigned();
			$table->integer('st_anterior_id')->unsigned();
            $table->integer('mes')->unsigned();
            $table->integer('usu_alta_id')->unsigned();
            $table->integer('usu_mod_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usu_mod_id')->references('id')->on('users');
            $table->foreign('usu_alta_id')->references('id')->on('users');
			$table->foreign('st_seguimiento_id')->references('id')->on('st_seguimientos');
			$table->foreign('st_anterior_id')->references('id')->on('st_seguimientos');
			$table->foreign('cliente_id')->references('id')->on('clientes');
			$table->foreign('seguimiento_id')->references('id')->on('seguimientos');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hs_seguimientos');
	}

}
