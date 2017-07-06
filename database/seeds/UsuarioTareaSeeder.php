<?php

use Illuminate\Database\Seeder;
use App\Modelos\UsuarioTarea;

class UsuarioTareaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UsuarioTarea::create([
        	'id_usuario' => '1',
        	'id_tarea' => '1',
        	]);
    }
}
