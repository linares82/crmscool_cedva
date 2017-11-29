<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeguimientoTareasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seguimiento_tareas', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('asignacion_tarea_id')->unsigned();
            $table->integer('estatus_id')->unsigned();
            $table->text('detalle');
            $table->integer('usu_alta_id')->unsigned();
            $table->integer('usu_mod_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usu_mod_id')->references('id')->on('users');
            $table->foreign('usu_alta_id')->references('id')->on('users');
            $table->foreign('estatus_id')->references('id')->on('st_tareas');
            $table->foreign('asignacion_tarea_id')->references('id')->on('asignacion_tareas');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('seguimiento_tareas');
	}

}
