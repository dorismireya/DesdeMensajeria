<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Modelos\Facultad;
use App\Modelos\Carrera;

class Web_CarreraController extends Controller
{
    public function index($id_carrera){

        $carrera= Carrera::findOrFail($id_carrera);

    	$facultad = Facultad::findOrFail($carrera->id_facultad);

        $carreras= DB::table('carreras')
        ->select('carreras.*')
        ->where('carreras.estado','=','activo')
        ->where('id_facultad','=',$facultad->id_facultad)
        ->orderBy('carreras.carrera','ASC')->get();

        $tipo_publicaciones= DB::table('ftipo_publicaciones')
        ->select('ftipo_publicaciones.*')
        ->where('ftipo_publicaciones.estado', '=', 'activo')
        ->orderBy('ftipo_publicaciones.posicion', 'ASC')->get();

        $nuevas_publicaciones= DB::table('fpublicaciones')
        ->join('ftipo_publicaciones', 'fpublicaciones.id_ftp', 'ftipo_publicaciones.id_ftp')
        ->select('fpublicaciones.*', 'ftipo_publicaciones.tipo as tipo')
        ->where('fpublicaciones.tabla', '=', 'facultad')
        ->where('fpublicaciones.id_tabla', '=', $facultad->id_facultad)
        ->where('fpublicaciones.estado', '=', 'publicado')
        ->orderBy('fpublicaciones.id_fpublicacion', 'desc')
        ->limit(3)->get();

        $semestres= DB::table('materias')
        ->select('materias.nivel as nivel')
        ->where('materias.estado', '=', 'activo')
        ->where('materias.id_carrera', '=', $id_carrera)
        ->groupBy('materias.nivel')
        ->orderBy('materias.nivel', 'asc')->get();

        $listar_materias= DB::table('materias')
        ->select('materias.*')
        ->where('materias.estado', '=', 'activo')
        ->where('materias.id_carrera', '=', $id_carrera)
        ->orderBy('materias.codigo', 'asc')->get();

        $carruseles= DB::table('files')
        ->select('files.*')
        ->where('files.tabla', '=', 'carrera')
        ->where('files.id_tabla', '=', $id_carrera)
        ->where('files.estado', '=', 'activo')
        ->orderBy('files.id_file', 'asc')->get();



    	return view('layouts.carrera.carrera', compact('facultad', 'carrera', 'tipo_publicaciones', 'carreras', 'nuevas_publicaciones','semestres', 'listar_materias', 'carruseles'));
    }

    /**
     * lista para retorar las dependenciasde las materias
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function listaDependencias(Request $request){

        $lista_materias= DB::table('materias')
        ->select('materias.id_materia as id_materia')
        ->where('materias.id_carrera', '=', $request->id_carrera)
        ->where('materias.estado', '=', 'activo')
        ->orderBy('materias.id_materia', 'asc')->get();

        $lista_dependencias= DB::table('dependencias')
        ->join('materias', 'dependencias.id_previa', 'materias.id_materia')
        ->select('materias.id_materia as id_materia', 'dependencias.id_materia as id_continua')
        ->where('materias.id_carrera', '=', $request->id_carrera)
        ->where('materias.estado', '=', 'activo')
        ->orderBy('materias.id_materia', 'asc')->get();

        return response()->json(array('lista_materias'=>$lista_materias, 'lista_dependencias'=>$lista_dependencias));
    }
}
