<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('grupos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('desc_corta');
            $table->integer('limite_alumnos')->unsigned();
			$table->integer('registrados')->unsigned()->nullable();
			$table->integer('minimo_alumnos')->unsigned();
            $table->integer('jornada_id')->unsigned();
            $table->integer('salon_id')->unsigned();
            $table->integer('periodo_estudio_id')->unsigned();
			$table->integer('plantel_id')->unsigned();
            $table->integer('usu_alta_id')->unsigned();
            $table->integer('usu_mod_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usu_mod_id')->references('id')->on('users');
            $table->foreign('usu_alta_id')->references('id')->on('users');
			$table->foreign('plantel_id')->references('id')->on('plantels');
			$table->foreign('periodo_estudio_id')->references('id')->on('periodo_estudios');
			$table->foreign('salon_id')->references('id')->on('salons');
			$table->foreign('jornada_id')->references('id')->on('jornadas');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('grupos');
	}

}
