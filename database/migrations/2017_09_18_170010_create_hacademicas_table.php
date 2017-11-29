<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHacademicasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hacademicas', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('inscripcion_id')->unsigned();
			$table->integer('cliente_id')->unsigned();
            $table->integer('plantel_id')->unsigned();
            $table->integer('especialidad_id')->unsigned();
            $table->integer('nivel_id')->unsigned();
            $table->integer('grado_id')->unsigned();
			$table->integer('grupo_id')->unsigned();
            $table->integer('materium_id')->unsigned();
            $table->integer('st_materium_id')->unsigned();
            $table->integer('lectivo_id')->unsigned();
            $table->integer('usu_alta_id')->unsigned();
            $table->integer('usu_mod_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usu_mod_id')->references('id')->on('users');
            $table->foreign('usu_alta_id')->references('id')->on('users');
			$table->foreign('lectivo_id')->references('id')->on('lectivos');
			$table->foreign('st_materium_id')->references('id')->on('st_materias');
			$table->foreign('materium_id')->references('id')->on('materia');
			$table->foreign('grupo_id')->references('id')->on('grupos');
			$table->foreign('grado_id')->references('id')->on('grados');
			$table->foreign('nivel_id')->references('id')->on('nivels');
			$table->foreign('especialidad_id')->references('id')->on('especialidads');
			$table->foreign('plantel_id')->references('id')->on('plantels');
			$table->foreign('cliente_id')->references('id')->on('clientes');
			$table->foreign('inscripcion_id')->references('id')->on('inscripcions');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hacademicas');
	}

}
