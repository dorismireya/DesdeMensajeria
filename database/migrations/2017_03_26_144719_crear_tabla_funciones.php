<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaFunciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funciones', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_funcion');
            $table->string('funcion')->unique()->required();
            $table->string('icono')->nullable();
            $table->string('detalle')->nullable();
            $table->string('estado')->required();
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
        Schema::dropIfExists('funciones');
    }
}

