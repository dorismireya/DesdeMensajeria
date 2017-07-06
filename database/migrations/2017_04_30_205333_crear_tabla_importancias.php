<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaImportancias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('importancias', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_importancia');
            $table->string('importancia')->unique()->required();
            $table->integer('posicion')->required();
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
        Schema::dropIfExists('importancias');
    }
}
