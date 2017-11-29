<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPlantelEspecialidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('especialidads', function (Blueprint $table) {
            $table->integer('plantel_id')->default(0)->unsigned();
            $table->integer('meta')->default(0)->unsigned();
            $table->foreign('plantel_id')->references('id')->on('plantels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('especialidads', function (Blueprint $table) {
            $table->dropIndex('');
            $table->dropColumn('plantel_id');
        });
    }
}
