<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modelos\Ufp;
use App\Modelos\Ucp;
use App\Modelos\Ump;
use App\Modelos\UsuarioImportancia;
use App\Modelos\UsuarioFtp;

class UserPublicacionController extends Controller
{
    public function index()
    {
        
    	$tarea_valida= DB::table('tareas')
    	->join('usuarios_tareas','usuarios_tareas.id_tarea','=','tareas.id_tarea')
    	->select(DB::raw('count(tareas.id_tarea) AS cantidad'))
    	->where('usuarios_tareas.id_usuario', '=', Auth()->user()->id)
    	->where('tareas.vista', '=', 'userPublicacion')->get();
		
		
		if($tarea_valida[0]->cantidad == 0)
			return view('adminlte::errors.404');

		$users= DB::table('users')
			->where('users.estado', '=', 'activo')
			->orderBy('users.name', 'asc')->get();

    	return view('adminlte::sistema.user_publicacion',compact('users'));
    }

    /**
     * funcion para retornar la lista de facultades
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function userPublicacion_Facultad(Request $request){

        $lista= DB::table('facultades')
        ->leftJoin('ufps', function($join) use($request){
            $join->on('facultades.id_facultad','=','ufps.id_facultad')
            ->where('ufps.id','=',$request->id);
        })
        ->select('facultades.*',DB::raw('count(ufps.id_ufp) AS cantidad')) 
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
    public function userPublicacion_FacultadInsert(Request $request){

        Ufp::where('id',$request->id)->where('id_facultad',$request->id_facultad)->delete();

        if($request->tipo == "si"){

	        $ufp= new Ufp();

	        $ufp->id= $request->id;
	        $ufp->id_facultad= $request->id_facultad;
	        $ufp->log= auth()->id();
	        
	        $ufp->save();

	        return response()->json($ufp);
        }

        return response()->json($request);
    }

    /**
     * funcion para retornar la lista de carreras
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function userPublicacion_Carrera(Request $request){

        $lista= DB::table('carreras')
        ->leftJoin('ucps', function($join) use($request){
            $join->on('carreras.id_carrera','=','ucps.id_carrera')
            ->where('ucps.id','=',$request->id);
        })
        ->select('carreras.*',DB::raw('count(ucps.id_ucp) AS cantidad'))
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
    public function userPublicacion_CarreraInsert(Request $request){

        Ucp::where('id',$request->id)->where('id_carrera',$request->id_carrera)->delete();

        if($request->tipo == "si"){

	        $ucp= new Ucp();

	        $ucp->id= $request->id;
	        $ucp->id_carrera= $request->id_carrera;
	        $ucp->log= auth()->id();
	        
	        $ucp->save();

	        return response()->json($ucp);
        }

        return response()->json($request);
    }

    /**
     * funcion para generar una lista de materias
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function userPublicacion_Materia(Request $request){

        $lista= DB::table('materias')
        ->leftJoin('umps', function($join) use($request){
            $join->on('materias.id_materia','=','umps.id_materia')
            ->where('umps.id','=',$request->id);
        })
        ->select('materias.*',DB::raw('count(umps.id_ump) AS cantidad'))
        ->where('materias.id_carrera','=',$request->id_carrera) 
        ->where('materias.estado','=','activo')
        ->groupBy('materias.id_materia')
        ->orderBy('materias.materia', 'ASC')->get();

        return response()->json($lista);
    }

    public function userPublicacion_MateriaInsert(Request $request){

        Ump::where('id',$request->id)->where('id_materia',$request->id_materia)->delete();

        if($request->tipo == "si"){

	        $ump= new Ump();

	        $ump->id= $request->id;
	        $ump->id_materia= $request->id_materia;
	        $ump->log= auth()->id();
	        
	        $ump->save();

	        return response()->json($ump);
        }

        return response()->json($request);
    }

    /**
     * funcion para retornar la lista de importancias 
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function userPublicacion_Importancia(Request $request){

        $lista= DB::table('importancias')
        ->leftJoin('usuarios_importancias', function($join) use($request){
            $join->on('importancias.id_importancia','=','usuarios_importancias.id_importancia')
            ->where('usuarios_importancias.id','=',$request->id);
        })
        ->select('importancias.*',DB::raw('count(usuarios_importancias.id_ui) AS cantidad')) 
        ->where('importancias.estado','=','activo')
        ->groupBy('importancias.id_importancia')
        ->orderBy('importancias.posicion', 'ASC')->get();

        return response()->json($lista);
    }

    /**
     * funcion para insertar la importancia
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function userPublicacion_ImportanciaInsert(Request $request){

        UsuarioImportancia::where('id',$request->id)->where('id_importancia',$request->id_importancia)->delete();

        if($request->tipo == "si"){

            $ui= new UsuarioImportancia();

            $ui->id= $request->id;
            $ui->id_importancia= $request->id_importancia;
            $ui->log= auth()->id();
            
            $ui->save();

            return response()->json($ui);
        }

        return response()->json($request);
    }

    /**
     * user publicacion tipo
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function userPublicacion_Tipo(Request $request){

        $lista= DB::table('ftipo_publicaciones')
        ->leftJoin('usuarios_ftps', function($join) use($request){
            $join->on('ftipo_publicaciones.id_ftp','=','usuarios_ftps.id_ftp')
            ->where('usuarios_ftps.id','=',$request->id);
        })
        ->select('ftipo_publicaciones.*',DB::raw('count(usuarios_ftps.id_uftp) AS cantidad')) 
        ->where('ftipo_publicaciones.estado','=','activo')
        ->groupBy('ftipo_publicaciones.id_ftp')
        ->orderBy('ftipo_publicaciones.posicion', 'ASC')->get();

        return response()->json($lista);
    }

    /**
     * Metodo para insertar el tipo de publicacion
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function userPublicacion_TipoInsert(Request $request){

        UsuarioFtp::where('id',$request->id)->where('id_ftp',$request->id_ftp)->delete();

        if($request->tipo == "si"){

            $uf= new UsuarioFtp();

            $uf->id= $request->id;
            $uf->id_ftp= $request->id_ftp;
            $uf->log= auth()->id();
            
            $uf->save();

            return response()->json($uf);
        }

        return response()->json($request);
    }
}
