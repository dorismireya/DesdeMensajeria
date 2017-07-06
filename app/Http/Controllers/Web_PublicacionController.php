<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modelos\Facultad;
use App\Modelos\FtipoPublicacion;
use App\Modelos\Usuario;
use App\Modelos\Importancia;

class Web_PublicacionController extends Controller
{
    public function index($id_ftp){

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

        $nuevas_publicaciones= DB::table('fpublicaciones')
        ->join('ftipo_publicaciones', 'fpublicaciones.id_ftp', 'ftipo_publicaciones.id_ftp')
        ->select('fpublicaciones.*', 'ftipo_publicaciones.tipo as tipo')
        ->where('fpublicaciones.tabla', '=', 'facultad')
        ->where('fpublicaciones.id_tabla', '=', $facultad->id_facultad)
        ->where('fpublicaciones.estado', '=', 'publicado')
        ->orderBy('fpublicaciones.id_fpublicacion', 'desc')
        ->limit(3)->get();

        $listar_publicaciones= DB::table('fpublicaciones')
        ->join('importancias', 'fpublicaciones.id_importancia', 'importancias.id_importancia')
        ->join('users', 'fpublicaciones.publicador', 'users.id')
        ->join('ftipo_publicaciones', 'fpublicaciones.id_ftp', 'ftipo_publicaciones.id_ftp')
        ->select('fpublicaciones.*', 'importancias.importancia as importancia', 'users.id as id', 'users.educacion as educacion', 'users.name as name', 'ftipo_publicaciones.tipo as tipo')
        ->where('fpublicaciones.estado', '=', 'publicado')
        ->where('fpublicaciones.id_ftp', '=', $id_ftp)
        ->orderBy('fpublicaciones.fecha_inicio', 'desc')
        ->orderBy('importancias.posicion', 'asc')->paginate(10);  


        $ftipo_publicacion = FtipoPublicacion::findOrFail($id_ftp);
        $titulo= $ftipo_publicacion->tipo;

        return view('layouts.publicacion.publicacion', compact('facultad', 'carreras', 'tipo_publicaciones', 'nuevas_publicaciones', 'titulo', 'listar_publicaciones'));
    }


    public function searchPublicacionUser($id){

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

        $nuevas_publicaciones= DB::table('fpublicaciones')
        ->join('ftipo_publicaciones', 'fpublicaciones.id_ftp', 'ftipo_publicaciones.id_ftp')
        ->select('fpublicaciones.*', 'ftipo_publicaciones.tipo as tipo')
        ->where('fpublicaciones.tabla', '=', 'facultad')
        ->where('fpublicaciones.id_tabla', '=', $facultad->id_facultad)
        ->where('fpublicaciones.estado', '=', 'publicado')
        ->orderBy('fpublicaciones.id_fpublicacion', 'desc')
        ->limit(3)->get();

        $listar_publicaciones= DB::table('fpublicaciones')
        ->join('importancias', 'fpublicaciones.id_importancia', 'importancias.id_importancia')
        ->join('users', 'fpublicaciones.publicador', 'users.id')
        ->join('ftipo_publicaciones', 'fpublicaciones.id_ftp', 'ftipo_publicaciones.id_ftp')
        ->select('fpublicaciones.*', 'importancias.importancia as importancia', 'users.id as id', 'users.educacion as educacion', 'users.name as name', 'ftipo_publicaciones.tipo as tipo')
        ->where('fpublicaciones.estado', '=', 'publicado')
        ->where('fpublicaciones.publicador', '=', $id)
        ->orderBy('fpublicaciones.fecha_inicio', 'desc')
        ->orderBy('importancias.posicion', 'asc')->paginate(10);  


        $usuario = Usuario::findOrFail($id);
        $titulo= $usuario->name;

        return view('layouts.publicacion.publicacion', compact('facultad', 'carreras', 'tipo_publicaciones', 'nuevas_publicaciones', 'titulo', 'listar_publicaciones'));
    }
}
