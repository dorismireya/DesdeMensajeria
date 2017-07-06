<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsuariosFtps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_ftps', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_uftp');
            $table->integer('id')->unsigned();
            $table->integer('id_ftp')->unsigned();
            $table->integer('log')->required();
            $table->timestamps(); 
        });

        Schema::table('usuarios_ftps', function (Blueprint $table) {
            
            $table->foreign('id')
                ->references('id')
                ->on('users');

            $table->foreign('id_ftp')
                ->references('id_ftp')
                ->on('ftipo_publicaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios_ftps');
    }
}
