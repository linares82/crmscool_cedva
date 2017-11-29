<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalificacionPonderacionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('calificacion_ponderacions', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('calificacion_id')->unsigned();
            $table->integer('carga_ponderacion_id')->unsigned();
            $table->decimal('calificacion_parcial');
			$table->decimal('calificacion_parcial_calculada');
			$table->decimal('ponderacion');
            $table->integer('usu_alta_id')->unsigned();
            $table->integer('usu_mod_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usu_mod_id')->references('id')->on('users');
            $table->foreign('usu_alta_id')->references('id')->on('users');
			$table->foreign('carga_ponderacion_id')->references('id')->on('carga_ponderacions');
			$table->foreign('calificacion_id')->references('id')->on('calificacions');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('calificacion_ponderacions');
	}

}
