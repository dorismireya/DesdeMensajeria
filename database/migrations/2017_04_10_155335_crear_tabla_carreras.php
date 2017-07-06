<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCarreras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carreras', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_carrera');
            $table->integer('id_facultad')->unsigned();
            $table->string('carrera')->unique()->required();
            $table->string('codigo')->nullable();
            $table->text('mision')->nullable();
            $table->text('vision')->nullable();
            $table->text('proyeccion')->nullable();
            $table->text('autoridad')->nullable();            
            $table->string('logo')->nullable();
            $table->text('detalle')->nullable();
            $table->integer('log')->required();
            $table->string('estado')->required();
            $table->timestamps();
            
        });

         Schema::table('carreras', function (Blueprint $table) {
            
            $table->foreign('id_facultad')
                ->references('id_facultad')
                ->on('facultades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('carreras');
    }
}
