<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menus', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('item');
            $table->string('imagen');
            $table->string('color');
            $table->integer('prioridad')->unsigned();
            $table->integer('activo')->unsigned();
            $table->string('link');
            $table->string('parametros');
            $table->string('permiso');
            $table->integer('padre')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('menus');
	}

}
