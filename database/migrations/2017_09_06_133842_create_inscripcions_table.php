<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscripcionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inscripcions', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('plantel_id')->unsigned();
            $table->integer('especialidad_id')->unsigned();
            $table->integer('nivel_id')->unsigned();
            $table->integer('grado_id')->unsigned();
            $table->integer('grupo_id')->unsigned();
            $table->integer('cliente_id')->unsigned();
            $table->date('fec_inscripcion');
            $table->integer('lectivo_id')->unsigned();
            $table->integer('usu_alta_id')->unsigned();
            $table->integer('usu_mod_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usu_mod_id')->references('id')->on('users');
            $table->foreign('usu_alta_id')->references('id')->on('users');
			$table->foreign('lectivo_id')->references('id')->on('lectivos');
			$table->foreign('cliente_id')->references('id')->on('clientes');
			$table->foreign('grado_id')->references('id')->on('grados');
			$table->foreign('nivel_id')->references('id')->on('nivels');
			$table->foreign('especialidad_id')->references('id')->on('especialidads');
			$table->foreign('plantel_id')->references('id')->on('plantels');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('inscripcions');
	}

}
