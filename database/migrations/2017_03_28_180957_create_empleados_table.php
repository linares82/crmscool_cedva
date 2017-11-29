<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empleados', function(Blueprint $table) {
            $table->increments('id');
            $table->string('cve_empleado');
            $table->string('nombre');
            $table->string('ape_paterno');
            $table->string('ape_materno')->nullable;
            $table->integer('puesto_id')->unsigned();
            $table->integer('area_id')->unsigned();
            $table->string('rfc');
            $table->string('curp');
            $table->string('direccion');
            $table->string('tel_fijo')->nullable();
            $table->string('tel_cel')->nullable();
            $table->string('cel_empresa')->nullable();
            $table->string('mail');
            $table->string('mail_empresa');
            $table->string('foto')->nullable();
            $table->string('identificacion')->nullable();
            $table->string('contrato')->nullable();
            $table->string('evaluacion_psico')->nullable();
            $table->integer('plantel_id')->unsigned();
            $table->integer('st_empleado_id')->unsigned();
            $table->integer('pendientes')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('usu_alta_id')->unsigned();
            $table->integer('usu_mod_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usu_mod_id')->references('id')->on('users');
            $table->foreign('usu_alta_id')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('st_empleado_id')->references('id')->on('st_empleados');
            $table->foreign('plantel_id')->references('id')->on('plantels');
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('puesto_id')->references('id')->on('puestos');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('empleados');
	}

}
