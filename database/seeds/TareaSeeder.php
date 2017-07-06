<?php

use Illuminate\Database\Seeder;
use App\Modelos\Tarea;

class TareaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tarea::create([
        	'tarea' => 'Funciones',
            'id_funcion' => 1,
        	'vista' => 'adminFuncion',
        	'detalle' => 'Admintrador de Funciones',
        	'estado' => 'activo',
        	]);
    }
}
