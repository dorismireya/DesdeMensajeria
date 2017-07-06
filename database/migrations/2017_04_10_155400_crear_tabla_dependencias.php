<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDependencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependencias', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_dependencia');
            $table->integer('id_materia')->unsigned();
            $table->integer('id_previa')->required();
            $table->integer('log')->required();
            $table->timestamps();
            
        });

         Schema::table('dependencias', function (Blueprint $table) {
            
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
        Schema::dropIfExists('dependencias');
    }
}
