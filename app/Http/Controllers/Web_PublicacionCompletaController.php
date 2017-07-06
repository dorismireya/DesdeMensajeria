<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modelos\Facultad;
use App\Modelos\Fpublicacion;
use App\Modelos\Usuario;
use App\Modelos\FtipoPublicacion;
use App\Modelos\Importancia;
use App\Modelos\Visita;
use Carbon\Carbon;
use stevebauman\location;

class Web_PublicacionCompletaController extends Controller
{
    public function index($id_fpublicacion){

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

        $fpublicacion = Fpublicacion::findOrFail($id_fpublicacion);
        $usuario = Usuario::findOrFail($fpublicacion->publicador);
        $ftipo_publicacion = FtipoPublicacion::findOrFail($fpublicacion->id_ftp);
        $importancia = Importancia::findOrFail($fpublicacion->id_importancia);

        $nuevas_publicaciones= DB::table('fpublicaciones')
        ->join('ftipo_publicaciones', 'fpublicaciones.id_ftp', 'ftipo_publicaciones.id_ftp')
        ->select('fpublicaciones.*', 'ftipo_publicaciones.tipo as tipo')
        ->where('fpublicaciones.tabla', '=', 'facultad')
        ->where('fpublicaciones.id_tabla', '=', $facultad->id_facultad)
        ->where('fpublicaciones.estado', '=', 'publicado')
        ->orderBy('fpublicaciones.id_fpublicacion', 'desc')
        ->limit(3)->get();

        $nombre_visitante= "";
        $localizacion= \Location::get(\Request::ip());

        if(Auth()->user() != null){

            $u = Usuario::findOrFail(Auth()->user()->id);
            $nombre_visitante= $u->name;
        }

        $visita= new Visita();

        $visita->visita= $nombre_visitante;
        $visita->id_fpublicacion= $id_fpublicacion;
        $visita->ciudad= $localizacion->cityName;
        $visita->ip= \Request::ip();
        $visita->fecha= Carbon::now();

        $visita->save();


    	return view('layouts.publicacion.publicacion_completa', compact('facultad', 'carreras', 'tipo_publicaciones', 'fpublicacion', 'usuario', 'ftipo_publicacion', 'importancia', 'nuevas_publicaciones'));
    }
}
