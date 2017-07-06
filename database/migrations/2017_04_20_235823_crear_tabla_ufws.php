<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUfws extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ufws', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_ufw');
            $table->integer('id')->unsigned();
            $table->integer('id_facultad')->unsigned();
            $table->integer('log')->required();
            $table->timestamps(); 
            
        });

        Schema::table('ufws', function (Blueprint $table) {
            
            
            $table->foreign('id')
                ->references('id')
                ->on('users');

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
        Schema::dropIfExists('ufws');
    }
}
