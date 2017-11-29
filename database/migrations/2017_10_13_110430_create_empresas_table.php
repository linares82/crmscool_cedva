<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('empresas', function(Blueprint $table) {
            $table->increments('id');
            $table->string('razon_social');
            $table->string('nombre_contacto')->nullable();
            $table->string('tel_fijo')->nullable();
            $table->string('tel_cel')->nullable();
            $table->string('correo1')->nullable();
            $table->string('correo2')->nullable();
            $table->string('calle')->nullable();
            $table->string('no_int')->string()->nullable();
            $table->string('no_ex')->string()->nullable();
            $table->string('colonia')->nullable();
            $table->integer('municipio_id')->unsigned();
            $table->integer('estado_id')->unsigned();
            $table->string('cp')->nullable();
            $table->integer('giro_id')->unsigned();
            $table->integer('plantel_id')->unsigned();
            $table->integer('especialidad_id')->unsigned();
            $table->integer('usu_alta_id')->unsigned();
            $table->integer('usu_mod_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usu_mod_id')->references('id')->on('users');
            $table->foreign('usu_alta_id')->references('id')->on('users');
            $table->foreign('giro_id')->references('id')->on('giros');
            $table->foreign('plantel_id')->references('id')->on('plantels');
            $table->foreign('especialidad_id')->references('id')->on('especialidads');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreign('municipio_id')->references('id')->on('municipios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('empresas');
    }

}
