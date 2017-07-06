<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaVisitas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_visita');
            $table->integer('id_fpublicacion')->unsigned();
            $table->string('visita')->required();
            $table->text('ciudad')->nullable();
            $table->ipAddress('ip')->required();
            $table->dateTime('fecha')->required();
            $table->timestamps(); 
        });
        Schema::table('visitas', function (Blueprint $table) {
            
            
            $table->foreign('id_fpublicacion')
                ->references('id_fpublicacion')
                ->on('fpublicaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitas');
    }
}
