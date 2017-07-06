<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaFacultades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facultades', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_facultad');
            $table->string('facultad')->unique()->required();
            $table->string('universidad')->required();
            $table->string('telefono')->nullable();
            $table->string('fax')->nullable();
            $table->string('web')->nullable();
            $table->string('direccion')->nullable();
            $table->text('autoridad')->nullable();
            $table->text('mision')->nullable();
            $table->text('vision')->nullable();
            $table->text('historia')->nullable();
            $table->string('logo')->nullable();
            $table->text('detalle')->nullable();
            $table->integer('log')->required();
            $table->string('estado')->required();
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
        Schema::dropIfExists('facultades');
    }
}
