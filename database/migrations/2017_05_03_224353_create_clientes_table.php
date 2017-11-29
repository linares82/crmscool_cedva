<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clientes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('cve_cliente')->nullable();
            $table->string('nombre')->nullable();
            $table->string('nombre2')->nullable();
            $table->string('ape_paterno')->nullable();
            $table->string('ape_materno')->nullable();
            $table->date('fec_registro')->nullable();
            $table->string('tel_fijo')->nullable();
            $table->string('tel_cel')->nullable();
            $table->string('mail')->nullable();
            $table->string('calle')->nullable();
            $table->string('no_exterior')->nullable();
            $table->string('no_interior')->nullable();
            $table->string('colonia')->nullable();
            $table->string('cp')->nullable();
            $table->integer('municipio_id')->unsigned();
            $table->integer('estado_id')->unsigned();
            $table->integer('especialidad_id')->unsigned();
            $table->integer('st_cliente_id')->unsigned();
            $table->integer('ofertum_id')->unsigned();
            $table->integer('medio_id')->unsigned();
            $table->string('expo')->nullable();
            $table->string('otro_medio')->nullable();
            $table->integer('empleado_id')->unsigned();
            $table->boolean('promociones')->nullable();
            $table->boolean('promo_cel')->nullable();
            $table->boolean('promo_correo')->nullable();
            $table->integer('nivel_id')->unsigned();
            $table->integer('grado_id')->unsigned();
            $table->integer('diplomado_id')->unsigned();
            $table->integer('subdiplomado_id')->unsigned();
            $table->integer('curso_id')->unsigned();
            $table->integer('subcurso_id')->unsigned();
            $table->integer('otro_id')->unsigned();
            $table->integer('subotro_id')->unsigned();
            $table->integer('plantel_id')->unsigned();
            $table->integer('usu_alta_id')->unsigned();
            $table->integer('usu_mod_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usu_mod_id')->references('id')->on('users');
            $table->foreign('usu_alta_id')->references('id')->on('users');
            $table->foreign('plantel_id')->references('id')->on('plantels');
            $table->foreign('nivel_id')->references('id')->on('nivels');
            $table->foreign('grado_id')->references('id')->on('grados');
            $table->foreign('diplomado_id')->references('id')->on('diplomados');
            $table->foreign('subdiplomado_id')->references('id')->on('subdiplomados');
            $table->foreign('curso_id')->references('id')->on('cursos');
            $table->foreign('otro_id')->references('id')->on('otros');
            $table->foreign('subotro_id')->references('id')->on('subotros');
            $table->foreign('empleado_id')->references('id')->on('empleados');
            $table->foreign('medio_id')->references('id')->on('medios');
            $table->foreign('ofertum_id')->references('id')->on('oferta');
            $table->foreign('st_cliente_id')->references('id')->on('st_clientes');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreign('municipio_id')->references('id')->on('municipios');
            $table->foreign('especialidad_id')->references('id')->on('especialidads');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('clientes');
	}

}
