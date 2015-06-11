<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsuarios extends Migration {

public function up()
	{
		//
            Schema::create('usuarios', function($table) {
            $table->increments('usu_id');
            $table->string('usu_nombre');
            $table->string('usu_username');
            $table->enum('usu_rol', array('administrador', 'operador'));
            $table->string('usu_clave');
            $table->string('usu_email');
           
        

            
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
            Schema::drop('usuarios');
	}

}
