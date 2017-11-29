<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plantels', function(Blueprint $table) {
            $table->increments('id');
            $table->string('razon');
            $table->string('rfc');
            $table->string('cve_incorporacion');
            $table->string('direccion');
            $table->string('tel');
            $table->string('mail');
            $table->string('pag_web');
            $table->integer('lectivo_id')->unsigned();
            $table->string('director');
            $table->string('director_tel');
            $table->string('director_mail');
            $table->string('rep_legal');
            $table->string('rep_legal_tel');
            $table->string('rep_legal_mail');
            $table->string('logo')->nullable();
            $table->string('slogan')->nullable();
            $table->string('membrete')->nullable();
            $table->integer('usu_alta_id')->unsigned();
            $table->integer('usu_mod_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usu_mod_id')->references('id')->on('users');
            $table->foreign('usu_alta_id')->references('id')->on('users');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('plantels');
	}

}
