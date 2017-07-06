<?php

namespace App\Http\Controllers;

use App\Http\Requests\TareaCreateRequest;
use App\Http\Requests\TareaUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modelos\Tarea;
use App\Modelos\Funcion;


class TareasController extends Controller
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

    public function create2($nameFuncion){

        $tarea_valida= DB::table('tareas')
        ->join('usuarios_tareas','usuarios_tareas.id_tarea','=','tareas.id_tarea')
        ->select(DB::raw('count(tareas.id_tarea) AS cantidad'))
        ->where('usuarios_tareas.id_usuario', '=', Auth()->user()->id)
        ->where('tareas.vista', '=', 'adminFuncion')->get();

        if($tarea_valida[0]->cantidad == 0)
            return view('adminlte::errors.404');

        $funciones= DB::table('funciones')->where('estado','=','activo')->orderBy('funcion','asc')->get();

        
        return view('adminlte::funciones.tareas_create',compact('funciones','nameFuncion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TareaCreateRequest $request)
    {
        Tarea::create($request->all());
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
        $tarea_valida= DB::table('tareas')
        ->join('usuarios_tareas','usuarios_tareas.id_tarea','=','tareas.id_tarea')
        ->select(DB::raw('count(tareas.id_tarea) AS cantidad'))
        ->where('usuarios_tareas.id_usuario', '=', Auth()->user()->id)
        ->where('tareas.vista', '=', 'adminFuncion')->get();
        
        
        if($tarea_valida[0]->cantidad == 0)
            return view('adminlte::errors.404');

        $funciones= DB::table('funciones')->where('estado','=','activo')->orderBy('funcion','asc')->get();

        $tarea = Tarea::findOrFail($id);
        return view('adminlte::funciones.tareas_edit', compact('tarea','funciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TareaUpdateRequest $request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->fill($request->all());
        $tarea->save();
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
}
