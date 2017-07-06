<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modelos\Facultad;

class AdminWebController extends Controller
{
    public function index(){

        $tarea_valida= DB::table('tareas')
        ->join('usuarios_tareas','usuarios_tareas.id_tarea','=','tareas.id_tarea')
        ->select(DB::raw('count(tareas.id_tarea) AS cantidad'))
        ->where('usuarios_tareas.id_usuario', '=', Auth()->user()->id)
        ->where('tareas.vista', '=', 'adminWeb')->get();
        
        
        if($tarea_valida[0]->cantidad == 0)
            return view('adminlte::errors.404');

        $facultades = DB::table('facultades')
        ->leftJoin('ufws', function($join){
            $join->on('facultades.id_facultad', '=', 'ufws.id_facultad')
            ->where('ufws.id', '=', Auth()->user()->id);
        })
        ->select('facultades.*', DB::raw('count(ufws.id_ufw) AS cantidad'))
        ->where('facultades.estado','=', 'activo')->get();


        return view('adminlte::sistema.admin_web', compact('facultades'));
    }

    /**
     * funcion para listar carreras
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function listarCarrera(Request $request){

        $lista= DB::table('carreras')
        ->leftJoin('ucws', function($join){
            $join->on('carreras.id_carrera','=','ucws.id_carrera')
            ->where('ucws.id','=',Auth()->user()->id);
        })
        ->select('carreras.*',DB::raw('count(ucws.id_ucw) AS cantidad'))
        ->where('carreras.id_facultad','=',$request->id_facultad) 
        ->where('carreras.estado','=','activo')
        ->groupBy('carreras.id_carrera')
        ->orderBy('carreras.carrera', 'ASC')->get();

        return response()->json($lista);
    }


    /**
     * funcion para listar materias
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function listarMateria(Request $request){

        $lista= DB::table('materias')
        ->leftJoin('umws', function($join){
            $join->on('materias.id_materia','=','umws.id_materia')
            ->where('umws.id','=',Auth()->user()->id);
        })
        ->select('materias.*',DB::raw('count(umws.id_umw) AS cantidad'))
        ->where('materias.id_carrera','=',$request->id_carrera) 
        ->where('materias.estado','=','activo')
        ->groupBy('materias.id_materia')
        ->orderBy('materias.materia', 'ASC')->get();

        return response()->json($lista);
    }
}
