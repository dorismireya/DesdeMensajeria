<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modelos\Tarea;
use App\Modelos\UsuarioTarea;

class TareasUsuariosController extends Controller
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

        UsuarioTarea::where('id_tarea',$id)->delete();

        if(count($arreglo)!= 0){

            $array;

            for($i=0; $i < count($arreglo); $i++) { 
            
                $array[$i]= ['id_usuario'=>$arreglo[$i], 'id_tarea'=>$id];   
            }


            UsuarioTarea::insert($array);
        }

        return redirect()->route('adminFuncion.index');
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

    /**
     * Listar las tareas por usuario
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function adminTarea($id){

        $tarea_valida= DB::table('tareas')
        ->join('usuarios_tareas','usuarios_tareas.id_tarea','=','tareas.id_tarea')
        ->select(DB::raw('count(tareas.id_tarea) AS cantidad'))
        ->where('usuarios_tareas.id_usuario', '=', Auth()->user()->id)
        ->where('tareas.vista', '=', 'adminFuncion')->get();
        
        
        if($tarea_valida[0]->cantidad == 0)
            return view('adminlte::errors.404');

        /*$tarea = DB::table('tareas')
        ->join('funciones','tareas.id_funcion', '=', 'funciones.id_funcion')
        ->select('tareas.*','funciones.funcion')
        ->where('tareas.id_tarea', '=', $id)->get();*/

        $tarea= Tarea::findOrFail($id);

        

        $tipos= DB::table('users')
        ->select('users.tipo')
        ->where('users.estado','=','activo')
        ->groupBy('users.tipo')
        ->orderBy('users.tipo','ASC')->get();


        
        $users= DB::table('users')
        ->leftJoin('usuarios_tareas', function($join) use($id){
            $join->on('users.id','=','usuarios_tareas.id_usuario')
            ->where('usuarios_tareas.id_tarea','=',$id);
        })
        ->select('users.*', DB::raw('count(usuarios_tareas.id_usuario_tarea) AS cantidad'))
        ->where('users.estado','=','activo')
        ->groupBy('users.id')
        ->orderBy('users.name','ASC')->get();



        return view('adminlte::funciones.tareas_usuarios',compact('tarea','tipos','users'));
    }
}
