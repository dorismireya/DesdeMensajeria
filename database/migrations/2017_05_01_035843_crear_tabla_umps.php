<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUmps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umps', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_ump');
            $table->integer('id')->unsigned();
            $table->integer('id_materia')->unsigned();
            $table->integer('log')->required();
            $table->timestamps(); 
            
        });

        Schema::table('umps', function (Blueprint $table) {
            
            
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
        Schema::dropIfExists('umps');
    }
}
