<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEspecialidadCombosClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->integer('especialidad2_id')->default(0)->unsigned();
            $table->foreign('especialidad2_id')->references('id')->on('especialidads');
            $table->integer('especialidad3_id')->default(0)->unsigned();
            $table->foreign('especialidad3_id')->references('id')->on('especialidads');
            $table->integer('especialidad4_id')->default(0)->unsigned();
            $table->foreign('especialidad4_id')->references('id')->on('especialidads');
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
