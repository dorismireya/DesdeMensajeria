<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaFpublicacionesEtiquetas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('fpublicaciones_etiquetas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_fpe');
            $table->integer('id_fpublicacion')->unsigned();
            $table->integer('id_etiqueta')->unsigned();
            $table->integer('log')->required();
            $table->timestamps(); 
            
        });

        Schema::table('fpublicaciones_etiquetas', function (Blueprint $table) {
            
            
            $table->foreign('id_fpublicacion')
                ->references('id_fpublicacion')
                ->on('fpublicaciones');

            $table->foreign('id_etiqueta')
                ->references('id_etiqueta')
                ->on('etiquetas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fpublicaciones_etiquetas');
    }
}
