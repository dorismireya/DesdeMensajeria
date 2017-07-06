<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUmws extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umws', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_umw');
            $table->integer('id')->unsigned();
            $table->integer('id_materia')->unsigned();
            $table->integer('log')->required();
            $table->timestamps(); 
            
        });

        Schema::table('umws', function (Blueprint $table) {
            
            
            $table->foreign('id')
                ->references('id')
                ->on('users');

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
        Schema::dropIfExists('umws');
    }
}
