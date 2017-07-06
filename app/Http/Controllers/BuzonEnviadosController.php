<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BuzonEnviadosController extends Controller
{
        public function index(){

    	$mensajes= DB::table('mensajes')
    	->join('mensajes_destinos', 'mensajes.id_mensaje', 'mensajes_destinos.id_mensaje')
    	->join('users', 'mensajes_destinos.id_destino', 'users.id')
    	->select('mensajes.*', DB::raw('group_concat(DISTINCT users.name order by users.name asc SEPARATOR ",") AS name'))
    	->where('mensajes.id_origen', '=', Auth()->user()->id)
    	->where('mensajes.estado', '=', 'activo')
    	->groupBy('mensajes.id_mensaje')
    	->orderBy('mensajes.fecha', 'desc')->paginate(20);

    	$old_search= "";

    	return view('adminlte::sistema.buzon_enviados', compact('mensajes', 'old_search'));
    }

    public function search(Request $request){

    	$param= "%".$request->input('buscar')."%";
        $old_search= $request->input('buscar');

    	$mensajes= DB::table('mensajes')
    	->join('mensajes_destinos', 'mensajes.id_mensaje', 'mensajes_destinos.id_mensaje')
    	->join('users', 'mensajes_destinos.id_destino', 'users.id')
    	->select('mensajes.*', DB::raw('group_concat(DISTINCT users.name order by users.name asc SEPARATOR ",") AS name'))
    	->orWhere(function($query) use($param){
    		$query->where('mensajes.asunto', 'like', $param)
    		->orWhere('mensajes.mensaje', 'like', $param)
    		->orWhere('users.name', 'like', $param);
    	})
    	->where('mensajes.id_origen', '=', Auth()->user()->id)
    	->where('mensajes.estado', '=', 'activo')
    	->groupBy('mensajes.id_mensaje')
    	->orderBy('mensajes.fecha', 'desc')->paginate(20);

    	return view('adminlte::sistema.buzon_enviados', compact('mensajes', 'old_search'));
    }
}
