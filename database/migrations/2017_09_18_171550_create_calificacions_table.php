<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalificacionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('calificacions', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('hacademica_id')->unsigned();
            $table->integer('tpo_examen_id')->unsigned();
            $table->decimal('calificacion');
            $table->date('fecha');
            $table->boolean('reporte_bnd');
            $table->integer('usu_alta_id')->unsigned();
            $table->integer('usu_mod_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usu_mod_id')->references('id')->on('users');
            $table->foreign('usu_alta_id')->references('id')->on('users');
			$table->foreign('tpo_examen_id')->references('id')->on('tpo_examens');
			$table->foreign('hacademica_id')->references('id')->on('hacademicas');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('calificacions');
	}

}
