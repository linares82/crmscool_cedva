<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignacionAcademicasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('asignacion_academicas', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('empleado_id')->unsigned();
            $table->integer('materium_id')->unsigned();
            $table->integer('grupo_id')->unsigned();
            $table->integer('horas')->unsigned();
			$table->integer('plantel_id')->unsigned();
			$table->integer('lectivo_id')->unsigned();
            $table->integer('usu_alta_id')->unsigned();
            $table->integer('usu_mod_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usu_mod_id')->references('id')->on('users');
            $table->foreign('usu_alta_id')->references('id')->on('users');
			$table->foreign('plantel_id')->references('id')->on('plantels');
			$table->foreign('grupo_id')->references('id')->on('grupos');
			$table->foreign('materium_id')->references('id')->on('materia');
			$table->foreign('empleado_id')->references('id')->on('empleados');
			$table->foreign('lectivo_id')->references('id')->on('lectivos');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('asignacion_academicas');
	}

}
