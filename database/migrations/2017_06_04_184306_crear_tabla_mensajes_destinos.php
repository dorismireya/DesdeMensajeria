<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaMensajesDestinos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes_destinos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_md');
            $table->integer('id_mensaje')->unsigned();
            $table->integer('id_destino')->unsigned();
            $table->timestamps(); 
        });
        Schema::table('mensajes_destinos', function (Blueprint $table) {
            
            
            $table->foreign('id_mensaje')
                ->references('id_mensaje')
                ->on('mensajes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensajes_destinos');
    }
}
