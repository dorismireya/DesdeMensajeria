<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BuzonController extends Controller
{
      public function index(){

    	$mensajes= DB::table('mensajes')
    	->join('mensajes_destinos', 'mensajes.id_mensaje', 'mensajes_destinos.id_mensaje')
    	->join('users', 'mensajes.id_origen', 'users.id')
    	->select('mensajes.*', 'users.name as name', 'mensajes_destinos.visto as visto', 'mensajes_destinos.id_md as id_md')
    	->where('mensajes_destinos.id_destino', '=', Auth()->user()->id)
    	->where('mensajes.estado', '=', 'activo')
    	->orderBy('mensajes.fecha', 'desc')->paginate(20);

    	$old_search= "";

    	return view('adminlte::sistema.buzon', compact('mensajes', 'old_search'));
    }

    public function search(Request $request){

    	$param= "%".$request->input('buscar')."%";
        $old_search= $request->input('buscar');

    	$mensajes= DB::table('mensajes')
    	->join('mensajes_destinos', 'mensajes.id_mensaje', 'mensajes_destinos.id_mensaje')
    	->join('users', 'mensajes.id_origen', 'users.id')
    	->select('mensajes.*', 'users.name as name', 'mensajes_destinos.visto as visto', 'mensajes_destinos.id_md as id_md')
    	->orWhere(function($query) use($param){
    		$query->where('mensajes.asunto', 'like', $param)
    		->orWhere('mensajes.mensaje', 'like', $param)
    		->orWhere('users.name', 'like', $param);
    	})
    	->where('mensajes_destinos.id_destino', '=', Auth()->user()->id)
    	->where('mensajes.estado', '=', 'activo')
    	->orderBy('mensajes.fecha', 'desc')->paginate(20);

    	return view('adminlte::sistema.buzon', compact('mensajes', 'old_search'));
    }
}
