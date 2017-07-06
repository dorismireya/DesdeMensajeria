<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modelos\Facultad;

class Web_UtiController extends Controller
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


    	return view('layouts.uti.uti_facultativa', compact('facultad', 'carreras', 'tipo_publicaciones'));
    }
}
