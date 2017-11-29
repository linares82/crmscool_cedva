<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMatriculaClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function(Blueprint $table) {
            $table->string('matricula')->nullable();
            $table->string('celular_confirmado')->nullable();
            $table->string('correo_confirmado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientes', function(Blueprint $table) {
            $table->dorpColumn('matricula');
            $table->dorpColumn('celular_confirmado');
            $table->dorpColumn('correo_confirmado');
        });
    }
}
