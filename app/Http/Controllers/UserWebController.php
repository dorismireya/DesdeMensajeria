<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modelos\Ufw;
use App\Modelos\Ucw;
use App\Modelos\Umw;

class UserWebController extends Controller
{
    
    public function index()
    {

    	$tarea_valida= DB::table('tareas')
    	->join('usuarios_tareas','usuarios_tareas.id_tarea','=','tareas.id_tarea')
    	->select(DB::raw('count(tareas.id_tarea) AS cantidad'))
    	->where('usuarios_tareas.id_usuario', '=', Auth()->user()->id)
    	->where('tareas.vista', '=', 'userWeb')->get();
		
		
		if($tarea_valida[0]->cantidad == 0)
			return view('adminlte::errors.404');

		$users= DB::table('users')
			->where('users.estado', '=', 'activo')
			->orderBy('users.name', 'asc')->get();

    	return view('adminlte::sistema.user_web',compact('users'));
    }

    /**
     * funcion para retornar la lista de facultades
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function userWeb_Facultad(Request $request){

        $lista= DB::table('facultades')
        ->leftJoin('ufws', function($join) use($request){
            $join->on('facultades.id_facultad','=','ufws.id_facultad')
            ->where('ufws.id','=',$request->id);
        })
        ->select('facultades.*',DB::raw('count(ufws.id_ufw) AS cantidad')) 
        ->where('facultades.estado','=','activo')
        ->groupBy('facultades.id_facultad')
        ->orderBy('facultades.facultad', 'ASC')->get();

        return response()->json($lista);
    }

    /**
     * funcion para generar un insert o un delete
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function userWeb_FacultadInsert(Request $request){

        Ufw::where('id',$request->id)->where('id_facultad',$request->id_facultad)->delete();

        if($request->tipo == "si"){

	        $ufw= new Ufw();

	        $ufw->id= $request->id;
	        $ufw->id_facultad= $request->id_facultad;
	        $ufw->log= auth()->id();
	        
	        $ufw->save();

	        return response()->json($ufw);
        }

        return response()->json($request);
    }

    /**
     * funcion para retornar la lista de carreras
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function userWeb_Carrera(Request $request){

        $lista= DB::table('carreras')
        ->leftJoin('ucws', function($join) use($request){
            $join->on('carreras.id_carrera','=','ucws.id_carrera')
            ->where('ucws.id','=',$request->id);
        })
        ->select('carreras.*',DB::raw('count(ucws.id_ucw) AS cantidad'))
        ->where('carreras.id_facultad','=',$request->id_facultad) 
        ->where('carreras.estado','=','activo')
        ->groupBy('carreras.id_carrera')
        ->orderBy('carreras.carrera', 'ASC')->get();

        return response()->json($lista);
    }

    /**
     * funcion para insertar o eliminar carreras
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function userWeb_CarreraInsert(Request $request){

        Ucw::where('id',$request->id)->where('id_carrera',$request->id_carrera)->delete();

        if($request->tipo == "si"){

	        $ucw= new Ucw();

	        $ucw->id= $request->id;
	        $ucw->id_carrera= $request->id_carrera;
	        $ucw->log= auth()->id();
	        
	        $ucw->save();

	        return response()->json($ucw);
        }

        return response()->json($request);
    }

    /**
     * funcion para generar una lista de materias
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function userWeb_Materia(Request $request){

        $lista= DB::table('materias')
        ->leftJoin('umws', function($join) use($request){
            $join->on('materias.id_materia','=','umws.id_materia')
            ->where('umws.id','=',$request->id);
        })
        ->select('materias.*',DB::raw('count(umws.id_umw) AS cantidad'))
        ->where('materias.id_carrera','=',$request->id_carrera) 
        ->where('materias.estado','=','activo')
        ->groupBy('materias.id_materia')
        ->orderBy('materias.materia', 'ASC')->get();

        return response()->json($lista);
    }

    public function userWeb_MateriaInsert(Request $request){

        Umw::where('id',$request->id)->where('id_materia',$request->id_materia)->delete();

        if($request->tipo == "si"){

	        $umw= new Umw();

	        $umw->id= $request->id;
	        $umw->id_materia= $request->id_materia;
	        $umw->log= auth()->id();
	        
	        $umw->save();

	        return response()->json($umw);
        }

        return response()->json($request);
    }
}
