<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Modelos\Fpublicacion;

class AdminPublicacionEditController extends Controller
{
    public function index($id_fpublicacion){


        $tarea_valida= DB::table('tareas')
        ->join('usuarios_tareas','usuarios_tareas.id_tarea','=','tareas.id_tarea')
        ->select(DB::raw('count(tareas.id_tarea) AS cantidad'))
        ->where('usuarios_tareas.id_usuario', '=', Auth()->user()->id)
        ->where('tareas.vista', '=', 'adminPublicacion')->get();
        
        
        if($tarea_valida[0]->cantidad == 0)
            return view('adminlte::errors.404');

        $fpublicacion= Fpublicacion::findOrFail($id_fpublicacion);

        $tipo_publicaciones= DB::table('ftipo_publicaciones')
        ->join('usuarios_ftps', 'ftipo_publicaciones.id_ftp', 'usuarios_ftps.id_ftp')
        ->select('ftipo_publicaciones.*')
        ->where('ftipo_publicaciones.estado', '=', 'activo')
        ->where('usuarios_ftps.id', '=', Auth()->user()->id)
        ->orderBy('ftipo_publicaciones.posicion', 'asc')->get();

        $importancias= DB::table('importancias')
        ->join('usuarios_importancias', 'importancias.id_importancia', 'usuarios_importancias.id_importancia')
        ->select('importancias.*')
        ->where('importancias.estado', '=', 'activo')
        ->where('usuarios_importancias.id', '=', Auth()->user()->id)
        ->orderBy('importancias.posicion', 'desc')->get();

        return view('adminlte::sistema.admin_publicacion_edit', compact('fpublicacion', 'tipo_publicaciones', 'importancias'));
    }

    public function publicacionEdit(Request $request) {

        $validator = Validator::make($request->all(), [
            'titulo' => 'required',
            'detalle' => 'required',
            'contenido' => 'required',
            'etiqueta' => 'required',
        ]);


        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        else {

            $fpublicacion = Fpublicacion::findOrFail($request->id_fpublicacion);

            $fpublicacion->titulo= $request->titulo;
            $fpublicacion->detalle= $request->detalle;
            $fpublicacion->contenido= $request->contenido;
            $fpublicacion->etiqueta= $request->etiqueta;
            $fpublicacion->publicador= auth()->id();
            $fpublicacion->fecha_inicio= $request->fecha_inicio;
            $fpublicacion->fecha_fin= $request->fecha_fin;
            $fpublicacion->id_importancia= $request->id_importancia;
            $fpublicacion->tabla= $request->tabla;
            $fpublicacion->id_tabla= $request->id_tabla;
            $fpublicacion->area= $request->area;
            $fpublicacion->id_ftp= $request->id_ftp;
            $fpublicacion->estado= $request->estado;
            $fpublicacion->log= auth()->id();
            
            $fpublicacion->save();


            return response()->json($fpublicacion);
        }
    }
    /**
     * funcion para listar las facultades
     * @return [type] [description]
     */
    public function listarFacultad(Request $request){

        $lista= DB::table('facultades')
        ->leftJoin('ufws', function($join){
            $join->on('facultades.id_facultad','=','ufws.id_facultad')
            ->where('ufws.id','=',Auth()->user()->id);
        })
        ->select('facultades.*',DB::raw('count(ufws.id_ufw) AS cantidad'))
        ->where('facultades.estado','=','activo')
        ->groupBy('facultades.id_facultad')
        ->orderBy('facultades.facultad', 'ASC')->get();

        return response()->json($lista);
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
        ->join('carreras', 'materias.id_carrera', 'carreras.id_carrera')
        ->leftJoin('umws', function($join){
            $join->on('materias.id_materia','=','umws.id_materia')
            ->where('umws.id','=',Auth()->user()->id);
        })
        ->select('materias.*', 'carreras.carrera as carrera',DB::raw('count(umws.id_umw) AS cantidad'))
        ->where('materias.id_carrera','=',$request->id_carrera) 
        ->where('materias.estado','=','activo')
        ->groupBy('materias.id_materia')
        ->orderBy('materias.materia', 'ASC')->get();

        return response()->json($lista);
    }
}
