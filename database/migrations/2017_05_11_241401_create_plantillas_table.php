<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantillasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plantillas', function(Blueprint $table) {
            $table->increments('id');
            $table->text('plantilla');
            $table->string('nombre');
            $table->string('asunto');
            $table->string('para_nombre');
            $table->integer('tpo_correo_id')->unsigned();
            $table->integer('st_cliente_id')->unsigned();
            $table->integer('periodo_id')->unsigned();
            $table->integer('dia')->unsigned();
            $table->integer('nivel_id')->unsigned();
            $table->date('inicio');
            $table->date('fin');
            $table->string('img1')->nullable();
            $table->string('img2')->nullable();
            $table->string('img3')->nullable();
            $table->integer('usu_alta_id')->unsigned();
            $table->integer('usu_mod_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usu_mod_id')->references('id')->on('users');
            $table->foreign('usu_alta_id')->references('id')->on('users');
            $table->foreign('periodo_id')->references('id')->on('periodos');
            $table->foreign('nivel_id')->references('id')->on('nivels');
            $table->foreign('st_cliente_id')->references('id')->on('st_clientes');
            $table->foreign('tpo_correo_id')->references('id')->on('tpo_correos');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('plantillas');
	}

}
