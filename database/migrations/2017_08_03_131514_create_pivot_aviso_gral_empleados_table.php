<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotAvisoGralEmpleadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pivot_aviso_gral_empleados', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('aviso_gral_id')->unsigned();
            $table->integer('empleado_id')->unsigned();
			$table->boolean('leido');
			$table->boolean('enviado');
            $table->integer('usu_alta_id')->unsigned();
            $table->integer('usu_mod_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usu_mod_id')->references('id')->on('users');
            $table->foreign('usu_alta_id')->references('id')->on('users');
			$table->foreign('empleado_id')->references('id')->on('empleados');
			$table->foreign('aviso_gral_id')->references('id')->on('aviso_grals');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pivot_aviso_gral_empleados');
	}

}
