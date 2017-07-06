<?php

use Illuminate\Database\Seeder;
use App\Modelos\Funcion;

class FuncionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Funcion::create([
        	'funcion' => 'Administrar',
        	'detalle' => 'Creamos Funcion Administrar',
        	'estado' => 'activo',
        	]);
    }
}
