<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteFieldsPlantelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plantels', function(Blueprint $table) {
            $table->dropColumn('rep_legal');
            $table->dropColumn('rep_legal_tel');
            $table->dropColumn('rep_legal_mail');
            $table->dropColumn('director');
            $table->dropColumn('director_tel');
            $table->dropColumn('director_mail');
            $table->dropColumn('direccion');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('plantels', function(Blueprint $table) {
            $table->string('director');
            $table->string('director_tel');
            $table->string('director_mail');
            $table->string('rep_legal');
            $table->string('rep_legal_tel');
            $table->string('rep_legal_mail');
            $table->string('direccion');
        });
    }
}
