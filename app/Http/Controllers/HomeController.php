<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {        
        return view('adminlte::home');
    }

    /**
     * Listar usuarios del sistema de administracion
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function listar_usuarios_mensaje(Request $request){

        $lista= DB::table('users')
        ->select('users.*')
        ->where('users.estado', '=', 'activo')
        ->where('users.id', '!=', Auth()->user()->id)
        ->orderBy('users.name', 'asc')->get();

        return response()->json($lista);
    }

}