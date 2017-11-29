<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarioEvaluacionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('calendario_evaluacions', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('lectivo_id')->unsigned();
            $table->integer('ponderacion_id')->unsigned();
            $table->integer('carga_ponderacion_id')->unsigned();
            $table->date('v_inicio');
            $table->date('v_fin');
            $table->integer('plantel_id')->unsigned();
            $table->integer('usu_alta_id')->unsigned();
            $table->integer('usu_mod_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('usu_mod_id')->references('id')->on('users');
            $table->foreign('usu_alta_id')->references('id')->on('users');
            $table->foreign('plantel_id')->references('id')->on('plantels');
            $table->foreign('carga_ponderacion_id')->references('id')->on('carga_ponderacions');
            $table->foreign('ponderacion_id')->references('id')->on('ponderacions');
            $table->foreign('lectivo_id')->references('id')->on('lectivos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('calendario_evaluacions');
    }

}
