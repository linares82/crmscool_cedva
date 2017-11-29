<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlantillasActivasPlantillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plantillas', function(Blueprint $table) {
            $table->boolean('activo_bnd');
            $table->boolean('sms_bnd');
            $table->boolean('mail_bnd');
            $table->string('sms')->nullable();
            $table->integer('especialidad_id')->unsigned();
            $table->integer('plantel_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plantilla', function(Blueprint $table) {
            $table->dropColumn('activo_bnd');
            $table->dropColumn('sms_bnd');
            $table->dropColumn('mail_bnd');
            $table->dropColumn('sms');
        });
    }
}
