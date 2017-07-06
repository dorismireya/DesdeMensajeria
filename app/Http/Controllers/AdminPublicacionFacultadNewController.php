<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Modelos\Facultad;
use App\Modelos\Fpublicacion;

class AdminPublicacionFacultadNewController extends Controller
{
    public function index($id_facultad){

        $facultad_valida= DB::table('users')
        ->join('ufps','users.id','=','ufps.id')
        ->select(DB::raw('count(ufps.id_facultad) AS cantidad'))
        ->where('users.id', '=', Auth()->user()->id)
        ->where('ufps.id_facultad', '=', $id_facultad)->get();

        if($facultad_valida[0]->cantidad == 0)
            return view('adminlte::errors.404');
        
        
        $facultad = Facultad::findOrFail($id_facultad);

        $tipo_publicaciones= DB::table('ftipo_publicaciones')
        ->select('ftipo_publicaciones.*')
        ->where('ftipo_publicaciones.estado', '=', 'activo')
        ->orderBy('ftipo_publicaciones.tipo', 'ASC')->get();

        $importancias= DB::table('importancias')
        ->join('usuarios_importancias', 'importancias.id_importancia', 'usuarios_importancias.id_importancia')
        ->select('importancias.*')
        ->where('importancias.estado', '=', 'activo')
        ->where('usuarios_importancias.id', '=', Auth()->user()->id)
        ->orderBy('importancias.posicion', 'desc')->get();

        return view('adminlte::sistema.admin_publicacion_facultad_new', compact('facultad', 'tipo_publicaciones', 'importancias'));
    }

    /**
     * funcion para guardar la publicacion de la facultad
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function publicacionFacultadAdd(Request $request) {

        $validator = Validator::make($request->all(), [
            'titulo' => 'required',
            'detalle' => 'required',
            'contenido' => 'required',
            'etiqueta' => 'required',
        ]);


        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        else {

            $fpublicacion= new Fpublicacion();

            $fpublicacion->titulo= $request->titulo;
            $fpublicacion->detalle= $request->detalle;
            $fpublicacion->contenido= $request->contenido;
            $fpublicacion->etiqueta= $request->etiqueta;
            $fpublicacion->publicador= auth()->id();
            $fpublicacion->fecha_inicio= $request->fecha_inicio;
            $fpublicacion->fecha_fin= $request->fecha_fin;
            $fpublicacion->id_importancia= $request->id_importancia;
            $fpublicacion->id_facultad= $request->id_facultad;
            $fpublicacion->id_ftp= $request->id_ftp;
            $fpublicacion->estado= $request->estado;
            $fpublicacion->log= auth()->id();
            
            $fpublicacion->save();


            return response()->json($fpublicacion);
        }
    }
}
