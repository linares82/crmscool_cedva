<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvisoGralsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aviso_grals', function(Blueprint $table) {
            $table->increments('id');
            $table->string('desc_corta');
			$table->text('aviso');
            $table->date('inicio');
            $table->date('fin');
			$table->integer('plantel_id')->unsigned();
			$table->integer('puesto_id')->unsigned();
            $table->integer('usu_alta_id')->unsigned();
            $table->integer('usu_mod_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
			$table->foreign('usu_mod_id')->references('id')->on('users');
            $table->foreign('usu_alta_id')->references('id')->on('users');
			$table->foreign('plantel_id')->references('id')->on('plantels');
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
		Schema::drop('aviso_grals');
	}

}
