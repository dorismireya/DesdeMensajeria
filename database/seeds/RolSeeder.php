<?php

use Illuminate\Database\Seeder;
use App\Modelos\Rol;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::create([
        	'rol' => 'Administrador',
        	'detalle' => 'Rol Administrador',
        	'estado' => 'activo',
        	]);
    }
}
