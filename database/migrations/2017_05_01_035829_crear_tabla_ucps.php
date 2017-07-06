<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUcps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ucps', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_ucp');
            $table->integer('id')->unsigned();
            $table->integer('id_carrera')->unsigned();
            $table->integer('log')->required();
            $table->timestamps(); 
            
        });

        Schema::table('ucps', function (Blueprint $table) {
            
            
            $table->foreign('id')
                ->references('id')
                ->on('users');

            $table->foreign('id_carrera')
                ->references('id_carrera')
                ->on('carreras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ucps');
    }
}
