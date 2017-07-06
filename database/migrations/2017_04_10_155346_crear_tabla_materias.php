<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaMaterias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_materia');
            $table->integer('id_carrera')->unsigned();
            $table->string('materia')->required();
            $table->string('nivel')->nullable();
            $table->string('codigo')->nullable();
            $table->string('sigla')->nullable();
            $table->text('horario')->nullable();
            $table->text('detalle')->nullable();
            $table->integer('log')->required();
            $table->string('estado')->required();
            $table->timestamps();
            
        });

         Schema::table('materias', function (Blueprint $table) {
            
            $table->foreign('id_carrera')
                ->references('id_carrera')
                ->on('carreras');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materias');
    }
}
