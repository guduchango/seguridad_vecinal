<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMensajes extends Migration {


	public function up()
	{
        Schema::create('alertas', function($table) {
            $table->increments('ale_id');
            $table->string('ale_ubicacion');
            $table->string('ale_mensaje');
            $table->enum('ale_tipo', array('tipo_1', 'tipo_2'));
            
            });
	}


	public function down()
	{
            Schema::drop('alertas');
	}

}
