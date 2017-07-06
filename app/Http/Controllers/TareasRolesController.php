<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modelos\Rol;
use App\Modelos\TareaRol;

class TareasRolesController extends Controller
{

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $arreglo= $request->input('checkbox');

        TareaRol::where('id_rol',$id)->delete();

        if(count($arreglo)!= 0){

            $array;

            for($i=0; $i < count($arreglo); $i++) { 
            
                $array[$i]= ['id_tarea'=>$arreglo[$i], 'id_rol'=>$id];   
            }


            TareaRol::insert($array);
        }

        return redirect()->route('roles.index');
    }

	public function adminRol($id){

        $tarea_valida= DB::table('tareas')
        ->join('usuarios_tareas','usuarios_tareas.id_tarea','=','tareas.id_tarea')
        ->select(DB::raw('count(tareas.id_tarea) AS cantidad'))
        ->where('usuarios_tareas.id_usuario', '=', Auth()->user()->id)
        ->where('tareas.vista', '=', 'adminRol')->get();
        
        
        if($tarea_valida[0]->cantidad == 0)
            return view('adminlte::errors.404');
        
		$rol = Rol::findOrFail($id);

		$funciones= DB::table('funciones')
        ->join('tareas','funciones.id_funcion','=','tareas.id_funcion')
        ->select('funciones.*')
        ->where('funciones.estado','=','activo')
        ->where('tareas.estado','=','activo')
        ->groupBy('funciones.id_funcion')
        ->orderBy('funciones.funcion','ASC')->get();

        $tareas= DB::table('tareas')
        ->leftJoin('tareas_roles', function($join) use($rol){
        	$join->on('tareas.id_tarea','=','tareas_roles.id_tarea')
        	->where('tareas_roles.id_rol','=',$rol->id_rol);
        })
        ->select('tareas.*', DB::raw('count(tareas_roles.id_tarea_rol) AS cantidad'))
        ->where('tareas.estado','=','activo')
        ->groupBy('tareas.id_tarea')
        ->orderBy('tareas.tarea','ASC')->get();


		return view('adminlte::funciones.tareas_roles',compact('rol','funciones','tareas'));
    }
}
