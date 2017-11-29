<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMateriasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('materia', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('abreviatura')->nullable();
            $table->boolean('seriada_bnd');
            $table->integer('serie_anterior')->unsigned();
            $table->integer('plantel_id')->unsigned();
            $table->integer('ponderacion_id')->unsigned()->default(0);
			$table->integer('usu_alta_id')->unsigned();
            $table->integer('usu_mod_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usu_mod_id')->references('id')->on('users');
            $table->foreign('usu_alta_id')->references('id')->on('users');
			$table->foreign('plantel_id')->references('id')->on('plantels');
			//$table->foreign('serie_anterior_id')->references('id')->on('materias');
			$table->foreign('ponderacion_id')->references('id')->on('ponderacions');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('materias');
	}

}
