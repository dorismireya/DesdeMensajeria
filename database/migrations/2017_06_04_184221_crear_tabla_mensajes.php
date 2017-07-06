<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaMensajes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_mensaje');
            $table->integer('id_origen')->unsigned();
            $table->string('asunto')->required();
            $table->text('mensaje')->nullable();
            $table->dateTime('fecha')->required();
            $table->string('estado')->required();
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
        Schema::dropIfExists('mensajes');
    }
}
