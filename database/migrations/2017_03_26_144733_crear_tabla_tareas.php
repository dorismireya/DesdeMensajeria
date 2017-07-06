<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTareas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

          Schema::create('tareas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_tarea');
            $table->integer('id_funcion')->unsigned();
            $table->string('tarea')->unique()->required();
            $table->string('vista')->required();
            $table->string('icono')->nullable();
            $table->string('detalle')->nullable();
            $table->string('estado')->required();
            $table->timestamps();

        });

         Schema::table('tareas', function (Blueprint $table) {
            
            $table->foreign('id_funcion')
                ->references('id_funcion')
                ->on('funciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas');
    }
}
