<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlantelSubotroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subotros', function(Blueprint $table) {
            $table->integer('plantel_id')->unsigned();
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
        Schema::table('subotros', function(Blueprint $table) {
            $table->dropForeign('subotros_plantel_id_foreign');
            $table->dropColumn('plantel_id')->unsigned();

        });
    }
}
