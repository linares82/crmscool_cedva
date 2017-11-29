<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlantillasEspecialidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantillas_especialidad', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plantilla_id')->unsigned();
            $table->integer('especialidad_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('plantilla_id')->references('id')->on('plantillas');
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
        //
    }
}
