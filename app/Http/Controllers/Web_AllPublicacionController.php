<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modelos\Facultad;
use App\Modelos\Carrera;
use App\Modelos\Materia;
use App\Modelos\FtipoPublicacion;
use App\Modelos\Usuario;
use App\Modelos\Importancia;

class Web_AllPublicacionController extends Controller
{
    public function index(){

    	$facultad = Facultad::findOrFail(1);

    	$carreras= DB::table('carreras')
        ->select('carreras.*')
        ->where('carreras.estado','=','activo')
        ->where('id_facultad','=',$facultad->id_facultad)
        ->orderBy('carreras.carrera','ASC')->get();

        $tipo_publicaciones= DB::table('ftipo_publicaciones')
        ->select('ftipo_publicaciones.*')
        ->where('ftipo_publicaciones.estado', '=', 'activo')
        ->orderBy('ftipo_publicaciones.posicion', 'ASC')->get();

        $tabla_consulta= "";
        $id_tabla_consulta= "";
        $old_search="";

        $tipo_consulta= "";

        $lista_publicaciones= DB::table('fpublicaciones')
        ->join('ftipo_publicaciones', 'fpublicaciones.id_ftp', 'ftipo_publicaciones.id_ftp')
        ->join('importancias', 'fpublicaciones.id_importancia', 'importancias.id_importancia')
        ->join('users', 'fpublicaciones.publicador', 'users.id')
        ->select('fpublicaciones.*', 'ftipo_publicaciones.tipo as tipo', 'importancias.importancia as importancia', 'users.id as id', 'users.educacion as educacion', 'users.name as name')
        ->where('fpublicaciones.estado', '=', 'publicado')
        ->orderBy('fpublicaciones.fecha_inicio', 'desc')
        ->orderBy('importancias.posicion', 'asc')
        ->orderBy('fpublicaciones.id_fpublicacion', 'desc')->paginate(10);

        $titulo= "Todas las Publicaciones";


    	return view('layouts.publicacion.all_publicacion', compact('facultad', 'carreras', 'tipo_publicaciones', 'lista_publicaciones', 'titulo', 'tabla_consulta', 'id_tabla_consulta', 'old_search', 'tipo_consulta'));
    }


    public function search(Request $request){

        $facultad = Facultad::findOrFail(1);

        $carreras= DB::table('carreras')
        ->select('carreras.*')
        ->where('carreras.estado','=','activo')
        ->where('id_facultad','=',$facultad->id_facultad)
        ->orderBy('carreras.carrera','ASC')->get();

        $tipo_publicaciones= DB::table('ftipo_publicaciones')
        ->select('ftipo_publicaciones.*')
        ->where('ftipo_publicaciones.estado', '=', 'activo')
        ->orderBy('ftipo_publicaciones.posicion', 'ASC')->get();

        $tabla_consulta= $request->input('tabla');
        $id_tabla_consulta= $request->input('id_tabla');
        $param= "%".$request->input('buscar')."%";
        $old_search= $request->input('buscar');

        $tipo_consulta= $request->input('tipo');

        $lista_publicaciones= DB::table('fpublicaciones')
        ->join('ftipo_publicaciones', 'fpublicaciones.id_ftp', 'ftipo_publicaciones.id_ftp')
        ->join('importancias', 'fpublicaciones.id_importancia', 'importancias.id_importancia')
        ->join('users', 'fpublicaciones.publicador', 'users.id')
        ->select('fpublicaciones.*', 'ftipo_publicaciones.tipo as tipo', 'importancias.importancia as importancia', 'users.id as id', 'users.educacion as educacion', 'users.name as name')
        ->orWhere(function ($query) use ($param){

            $query->where('fpublicaciones.titulo', 'like', $param)
            ->orWhere('fpublicaciones.detalle', 'like', $param)
            ->orWhere('fpublicaciones.area', 'like', $param)
            ->orWhere('users.name', 'like', $param);
        })
        ->where('fpublicaciones.estado', '=', 'publicado')
        ->when($tabla_consulta != "", function($query) use ($tabla_consulta, $id_tabla_consulta){
                return $query->where('fpublicaciones.tabla', $tabla_consulta)->where('fpublicaciones.id_tabla', $id_tabla_consulta);
            })
        ->when($tipo_consulta != "", function($query) use ($tipo_consulta){
                return $query->where('ftipo_publicaciones.tipo', $tipo_consulta);
            })
        ->orderBy('fpublicaciones.fecha_inicio', 'desc')
        ->orderBy('importancias.posicion', 'asc')
        ->orderBy('fpublicaciones.id_fpublicacion', 'desc')->paginate(10);

        $titulo= "Todos";

        if($tipo_consulta!= "")
            $titulo= $tipo_consulta;

        if($tabla_consulta!= ""){

            if($tabla_consulta == "facultad"){
                $fac= Facultad::findOrFail($id_tabla_consulta);
                $titulo= $fac->facultad;
            }

            if($tabla_consulta == "carrera"){
                $carr= Carrera::findOrFail($id_tabla_consulta);
                $titulo= $carr->carrera;
            }

            if($tabla_consulta == "materia"){

                $mat= Materia::findOrFail($id_tabla_consulta);
                $titulo= $mat->materia;

                $carr= Carrera::findOrFail($mat->id_carrera);

                $titulo= $carr->carrera." - ".$titulo;
            }
        }

        return view('layouts.publicacion.all_publicacion', compact('facultad', 'carreras', 'tipo_publicaciones', 'lista_publicaciones', 'titulo', 'tabla_consulta', 'id_tabla_consulta', 'old_search', 'tipo_consulta'));
    }
}