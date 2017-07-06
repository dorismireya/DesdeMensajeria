<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuncionCreateRequest;
use App\Http\Requests\FuncionUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modelos\Funcion;
use App\Modelos\Tarea;
use App\Modelos\UsuarioTarea;
use App\Modelos\TareaRol;


class FuncionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$funciones = Funcion::all();
        
        return view('funcion.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $tarea_valida= DB::table('tareas')
        ->join('usuarios_tareas','usuarios_tareas.id_tarea','=','tareas.id_tarea')
        ->select(DB::raw('count(tareas.id_tarea) AS cantidad'))
        ->where('usuarios_tareas.id_usuario', '=', Auth()->user()->id)
        ->where('tareas.vista', '=', 'adminFuncion')->get();

        if($tarea_valida[0]->cantidad == 0)
            return view('adminlte::errors.404');

        return view('adminlte::funciones.funciones_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FuncionCreateRequest $request)
    {

        Funcion::create($request->all());
        return redirect()->route('adminFuncion.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $funcion = Funcion::findOrFail($id);
        return view('funciones.view11', compact('funcion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tarea_valida= DB::table('tareas')
        ->join('usuarios_tareas','usuarios_tareas.id_tarea','=','tareas.id_tarea')
        ->select(DB::raw('count(tareas.id_tarea) AS cantidad'))
        ->where('usuarios_tareas.id_usuario', '=', Auth()->user()->id)
        ->where('tareas.vista', '=', 'adminFuncion')->get();
        
        
        if($tarea_valida[0]->cantidad == 0)
            return view('adminlte::errors.404');
        
        $funcion = Funcion::findOrFail($id);
        return view('adminlte::funciones.funciones_edit', compact('funcion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FuncionUpdateRequest $request, $id)
    {
        $funcion = Funcion::findOrFail($id);
        $funcion->fill($request->all());
        $funcion->save();
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
        $funcion = Funcion::findOrFail($id);
        $funcion->delete();
        return redirect()->route('adminFuncion.index');
    }

    /**
     * Eliminar tarea
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroyTarea($id)
    {

        UsuarioTarea::where('id_tarea',$id)->delete();
        TareaRol::where('id_tarea',$id)->delete();


        $funcion = Tarea::findOrFail($id);
        $funcion->delete();
        return redirect()->route('adminFuncion.index');
    }
}
