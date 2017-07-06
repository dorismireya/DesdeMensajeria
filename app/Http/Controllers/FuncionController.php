<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FuncionController extends Controller
{
    public function index()
    {

    	$tarea_valida= DB::table('tareas')
    	->join('usuarios_tareas','usuarios_tareas.id_tarea','=','tareas.id_tarea')
    	->select(DB::raw('count(tareas.id_tarea) AS cantidad'))
    	->where('usuarios_tareas.id_usuario', '=', Auth()->user()->id)
    	->where('tareas.vista', '=', 'adminFuncion')->get();
		
		
		if($tarea_valida[0]->cantidad == 0)
			return view('adminlte::errors.404');

		unset($arreglos);
		$puntero= 0;

		$funciones= DB::table('funciones')
		->leftJoin('tareas','funciones.id_funcion','=','tareas.id_funcion')
		->select('funciones.*', DB::raw('count(tareas.id_tarea) AS cantidad')) 
		->where('funciones.estado', '=', 'activo')
		->groupBy('funciones.id_funcion')
		->orderBy('funciones.funcion','ASC')->get();

		
		foreach ($funciones as $funcion ) {

			$arreglos[$puntero][0]= "funcion";
			$arreglos[$puntero][1]= $funcion->id_funcion;
			$arreglos[$puntero][2]= $funcion->funcion;
			$arreglos[$puntero][3]= "";
			$arreglos[$puntero][4]= $funcion->icono;
			$arreglos[$puntero][5]= $funcion->detalle;
			$arreglos[$puntero][6]= $funcion->cantidad;

			$puntero= $puntero+1;


			$tareas= DB::table('tareas')
			->where('tareas.id_funcion','=',$funcion->id_funcion)
			->where('tareas.estado', '=', 'activo')
			->orderBy('tareas.tarea', 'asc')->get();

			foreach ($tareas as $tarea) {
				
				$arreglos[$puntero][0]= "tarea";
				$arreglos[$puntero][1]= $tarea->id_tarea;
				$arreglos[$puntero][2]= $tarea->tarea;
				$arreglos[$puntero][3]= $tarea->vista;
				$arreglos[$puntero][4]= $tarea->icono;
				$arreglos[$puntero][5]= $tarea->detalle;
				$arreglos[$puntero][6]= $tarea->id_funcion;

				$puntero= $puntero+1;
			}

		}

        return view('adminlte::funciones.funciones')->with('arreglos', $arreglos);
    }
}
