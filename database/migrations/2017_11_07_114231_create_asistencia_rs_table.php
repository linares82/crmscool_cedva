<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsistenciaRsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('asistencia_rs', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('asignacion_academica_id')->unsigned();
            $table->date('fecha');
            $table->integer('cliente_id')->unsigned();
            $table->integer('est_asistencia_id')->unsigned();
            $table->integer('usu_alta_id')->unsigned();
            $table->integer('usu_mod_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usu_mod_id')->references('id')->on('users');
            $table->foreign('usu_alta_id')->references('id')->on('users');
            $table->foreign('est_asistencia_id')->references('id')->on('est_asistencias');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('asignacion_acdemica_id')->references('id')->on('asignacion_academicas');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('asistencia_rs');
	}

}
