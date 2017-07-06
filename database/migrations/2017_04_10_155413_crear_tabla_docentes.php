<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDocentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_docente');
            $table->integer('id')->unsigned();
            $table->string('tipo')->unique()->required();
            $table->string('telefono')->nullable();
            $table->string('educacion')->nullable();
            $table->text('biografia')->nullable();
            $table->string('foto')->nullable();
            $table->string('detalle')->nullable();
            $table->integer('log')->required();
            $table->string('estado')->required();
            $table->timestamps();
            
        });

         Schema::table('docentes', function (Blueprint $table) {
            
            $table->foreign('id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docentes');
    }
}
