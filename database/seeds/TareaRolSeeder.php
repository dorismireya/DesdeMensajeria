<?php

use Illuminate\Database\Seeder;
use App\Modelos\TareaRol;

class TareaRolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TareaRol::create([
        	'id_tarea' => '1',
        	'id_rol' => '1',
        	]);
    }
}
