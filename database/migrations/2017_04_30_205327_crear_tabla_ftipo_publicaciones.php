<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaFtipoPublicaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ftipo_publicaciones', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_ftp');
            $table->string('tipo')->unique()->required();
            $table->string('detalle')->required();
            $table->string('estado')->required();
            $table->integer('posicion')->required();
            $table->integer('log')->required();
            $table->timestamps(); 
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ftipo_publicaciones');
    }
}
