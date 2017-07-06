<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsuariosTareas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_tareas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_usuario_tarea');
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_tarea')->unsigned();
            $table->timestamps(); 
        });

        Schema::table('usuarios_tareas', function (Blueprint $table) {
            
            $table->foreign('id_usuario')
                ->references('id')
                ->on('users');

            $table->foreign('id_tarea')
                ->references('id_tarea')
                ->on('tareas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios_tareas');
    }
}
