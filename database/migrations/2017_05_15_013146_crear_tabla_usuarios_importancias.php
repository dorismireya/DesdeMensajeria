<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsuariosImportancias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_importancias', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_ui');
            $table->integer('id')->unsigned();
            $table->integer('id_importancia')->unsigned();
            $table->integer('log')->required();
            $table->timestamps(); 
        });

        Schema::table('usuarios_importancias', function (Blueprint $table) {
            
            $table->foreign('id')
                ->references('id')
                ->on('users');

            $table->foreign('id_importancia')
                ->references('id_importancia')
                ->on('importancias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios_importancias');
    }
}
