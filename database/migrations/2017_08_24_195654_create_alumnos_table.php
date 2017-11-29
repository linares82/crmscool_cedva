<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alumnos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('matricula')->nullable();
            $table->string('nombre')->nullable();
            $table->string('nombre2')->nullable();
            $table->string('ape_paterno')->nullable();
            $table->string('ape_materno')->nullable();
            $table->boolean('genero');
            $table->string('curp')->nullable();
            $table->date('fec_nacimiento')->nullable();
            $table->string('lugar_nacimiento')->nullable();
            $table->boolean('extranjero');
            $table->date('fec_inscripcion');
            $table->string('tel_fijo')->nullable();
            $table->string('tel_cel')->nullable();
            $table->string('cel_empresa')->nullable();
            $table->string('mail')->nullable();
            $table->string('mail_empresa')->nullable();
            $table->string('calle')->nullable();
            $table->string('no_interior')->nullable();
            $table->string('no_exterior')->nullable();
            $table->string('colonia')->nullable();
            $table->string('cp')->nullable();
            $table->integer('municipio_id')->unsigned();
            $table->integer('estado_id')->unsigned();
            $table->integer('st_alumno_id')->unsigned();
            $table->string('distancia_escuela')->nullable();
            $table->string('peso')->nullable();
            $table->string('estatura')->nullable();
            $table->string('tipo_sangre')->nullable();
            $table->string('alergias')->nullable();
            $table->string('medicinas_contraindicadas')->nullable();
            $table->string('color_piel')->nullable();
            $table->string('color_cabello')->nullable();
            $table->string('senas_particulares')->nullable();
            $table->string('nombre_padre')->nullable();
            $table->string('curp_padre')->nullable();
            $table->string('dir_padre')->nullable();
            $table->string('tel_padre')->nullable();
            $table->string('cel_padre')->nullable();
            $table->string('tel_ofi_padre')->nullable();
            $table->string('mail_padre')->nullable();
            $table->string('nombre_madre')->nullable();
            $table->string('curp_madre')->nullable();
            $table->string('dir_madre')->nullable();
            $table->string('tel_madre')->nullable();
            $table->string('cel_madre')->nullable();
            $table->string('tel_ofi_madre')->nullable();
            $table->string('mail_madre')->nullable();
            $table->string('nombre_acudiente')->nullable();
            $table->string('curp_acudiente')->nullable();
            $table->string('dir_acudiente')->nullable();
            $table->string('tel_acudiente')->nullable();
            $table->string('cel_acudiente')->nullable();
            $table->string('tel_ofi_acudiente')->nullable();
            $table->string('mail_acudiente')->nullable();
            $table->integer('plantel_id')->unsigned();
            $table->integer('especialidad_id')->unsigned();
            $table->integer('nivel_id')->unsigned();
            $table->integer('grado_id')->unsigned();
            $table->integer('grupo_id')->unsigned();
            $table->integer('lectivo_id')->unsigned();
            $table->string('cve_alumno')->nullable();
            $table->integer('usu_alta_id')->unsigned();
            $table->integer('usu_mod_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usu_mod_id')->references('id')->on('users');
            $table->foreign('usu_alta_id')->references('id')->on('users');
            $table->foreign('grado_id')->references('id')->on('grados');
            $table->foreign('grupo_id')->references('id')->on('grupos');
            $table->foreign('lectivo_id')->references('id')->on('lectivos');
            $table->foreign('nivel_id')->references('id')->on('nivels');
            $table->foreign('especialidad_id')->references('id')->on('especialidads');
            $table->foreign('plantel_id')->references('id')->on('plantels');
            $table->foreign('st_alumno_id')->references('id')->on('st_alumnos');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreign('municipio_id')->references('id')->on('municipios');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('alumnos');
	}

}
