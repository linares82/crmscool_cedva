<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PeriodoMateria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodo_materium', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('periodo_estudio_id')->unsigned();
            $table->integer('materium_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('periodo_estudio_id')->references('id')->on('periodo_estudios');
			$table->foreign('materium_id')->references('id')->on('materia');
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
