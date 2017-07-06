<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modelos\Usuario;
use App\Modelos\UsuarioTarea;

class UsuariosTareasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $arreglo= $request->input('checkbox');

        UsuarioTarea::where('id_usuario',$id)->delete();

        if(count($arreglo)!= 0){

            $array;

            for($i=0; $i < count($arreglo); $i++) { 
            
                $array[$i]= ['id_tarea'=>$arreglo[$i], 'id_usuario'=>$id];   
            }


            UsuarioTarea::insert($array);
        }

        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function adminUsuario($id){

        $tarea_valida= DB::table('tareas')
        ->join('usuarios_tareas','usuarios_tareas.id_tarea','=','tareas.id_tarea')
        ->select(DB::raw('count(tareas.id_tarea) AS cantidad'))
        ->where('usuarios_tareas.id_usuario', '=', Auth()->user()->id)
        ->where('tareas.vista', '=', 'adminUsuario')->get();
        
        
        if($tarea_valida[0]->cantidad == 0)
            return view('adminlte::errors.404');


        $usuario = Usuario::findOrFail($id);

        $funciones= DB::table('funciones')
        ->join('tareas','funciones.id_funcion','=','tareas.id_funcion')
        ->select('funciones.*')
        ->where('funciones.estado','=','activo')
        ->where('tareas.estado','=','activo')
        ->groupBy('funciones.id_funcion')
        ->orderBy('funciones.funcion','ASC')->get();

        $tareas= DB::table('tareas')
        ->leftJoin('usuarios_tareas', function($join) use($usuario){
            $join->on('tareas.id_tarea','=','usuarios_tareas.id_tarea')
            ->where('usuarios_tareas.id_usuario','=',$usuario->id);
        })
        ->select('tareas.*', DB::raw('count(usuarios_tareas.id_usuario_tarea) AS cantidad'))
        ->where('tareas.estado','=','activo')
        ->groupBy('tareas.id_tarea')
        ->orderBy('tareas.tarea','ASC')->get();


        return view('adminlte::funciones.usuarios_tareas',compact('usuario','funciones','tareas'));
    }
}
