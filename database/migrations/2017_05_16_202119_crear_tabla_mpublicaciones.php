<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaMpublicaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpublicaciones', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_mpublicacion');
            $table->string('titulo')->required();
            $table->string('detalle')->required();
            $table->text('contenido')->required();
            $table->string('etiqueta')->required();
            $table->integer('publicador')->required();
            $table->date('fecha_inicio')->required();
            $table->date('fecha_fin')->required();
            $table->integer('id_importancia')->unsigned();
            $table->integer('id_materia')->unsigned();
            $table->integer('id_ftp')->unsigned();
            $table->string('estado')->required();
            $table->integer('log')->required();
            $table->timestamps(); 
            
        });

        Schema::table('mpublicaciones', function (Blueprint $table) {
            

            $table->foreign('id_materia')
                ->references('id_materia')
                ->on('materias');

            $table->foreign('id_ftp')
                ->references('id_ftp')
                ->on('ftipo_publicaciones');

            $table->foreign('id_importancia')
                ->references('id_importancia')
                ->on('importancias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mpublicaciones');
    }
}
