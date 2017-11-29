<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvisosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('avisos', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('seguimiento_id')->unsigned();
            $table->integer('asunto_id')->unsigned();
            $table->string('detalle');
            $table->date('fecha');
            $table->boolean('activo');
            $table->integer('usu_alta_id')->unsigned();
            $table->integer('usu_mod_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usu_mod_id')->references('id')->on('users');
            $table->foreign('usu_alta_id')->references('id')->on('users');
			$table->foreign('asunto_id')->references('id')->on('asuntos');
			$table->foreign('seguimiento_id')->references('id')->on('seguimientos');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('avisos');
	}

}
