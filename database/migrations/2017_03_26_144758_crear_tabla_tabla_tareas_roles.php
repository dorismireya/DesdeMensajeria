<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTablaTareasRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas_roles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_tarea_rol');
            $table->integer('id_tarea')->unsigned();
            $table->integer('id_rol')->unsigned();
            $table->timestamps(); 

            
        });

        Schema::table('tareas_roles', function (Blueprint $table) {
            
            
            $table->foreign('id_tarea')
                ->references('id_tarea')
                ->on('tareas');

            $table->foreign('id_rol')
                ->references('id_rol')
                ->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas_roles');
    }
}

