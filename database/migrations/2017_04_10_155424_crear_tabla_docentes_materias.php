<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDocentesMaterias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('docentes_materias', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_docentes_materias');
            $table->integer('id_docente')->unsigned();
            $table->integer('id_materia')->unsigned();
            $table->integer('log')->required();
            $table->timestamps(); 

            
        });

        Schema::table('docentes_materias', function (Blueprint $table) {
            
            
            $table->foreign('id_docente')
                ->references('id_docente')
                ->on('docentes');

            $table->foreign('id_materia')
                ->references('id_materia')
                ->on('materias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docentes_materias');
    }
}
