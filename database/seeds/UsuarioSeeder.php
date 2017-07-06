<?php

use Illuminate\Database\Seeder;
use App\Modelos\Usuario as User;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Administrador
        User::create([
        	'name' => 'Mireya Terceros',
        	'email' => 'mir.nereidas@gmail.com',
        	'password' => '123456',
        	'tipo' => 'adm',
            'estado' => 'activo',
        	]);
    }
}
