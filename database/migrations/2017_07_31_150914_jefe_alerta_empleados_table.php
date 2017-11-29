<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JefeAlertaEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empleados', function(Blueprint $table) {
            $table->boolean('extranjero_bnd');
            $table->boolean('genero');
            $table->boolean('alimenticia_bnd');
            $table->boolean('jefe_bnd');
            $table->integer('jefe_id')->unsigned();
            $table->boolean('alerta_bnd');
            $table->integer('dias_alerta')->unsigned();
            $table->integer('resp_alerta_id')->unsigned();
            $table->date('fin_contrato')->nullable();
            $table->integer('regresiva')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empleados', function(Blueprint $table) {
            $table->dropColumn('jefe_bnd');
            $table->dropColumn('jefe_id');
            $table->dropColumn('alerta_bnd');
            $table->dropColumn('dias_alerta');
            $table->dropColumn('resp_alerta_id');
            $table->dropColumn('fin_contrato');
        });
    }
}
