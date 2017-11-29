<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InscripcionesClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->string('cve_alumno')->nullable();
            $table->boolean('genero')->nullable();
            $table->string('curp')->nullable();
            $table->date('fec_nacimiento')->nullable();
            $table->string('lugar_nacimiento')->nullable();
            $table->boolean('extranjero')->nullable();
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
