<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolCreateRequest;
use App\Http\Requests\RolUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modelos\Rol;
use App\Modelos\TareaRol;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $tarea_valida= DB::table('tareas')
            ->join('usuarios_tareas','usuarios_tareas.id_tarea','=','tareas.id_tarea')
            ->select(DB::raw('count(tareas.id_tarea) AS cantidad'))
            ->where('usuarios_tareas.id_usuario', '=', Auth()->user()->id)
            ->where('tareas.vista', '=', 'adminRol')->get();
            
            
            if($tarea_valida[0]->cantidad == 0)
                return view('adminlte::errors.404');

        $roles= DB::table('roles')
        ->leftJoin('tareas_roles','roles.id_rol','=','tareas_roles.id_rol')
        ->select('roles.*', DB::raw('count(tareas_roles.id_tarea_rol) AS cantidad'))
        ->where('roles.estado', '=', 'activo')
        ->groupBy('roles.id_rol')
        ->orderBy('roles.rol', 'ASC')->get();

        $funciones= DB::table('funciones')
        ->join('tareas','funciones.id_funcion','=','tareas.id_funcion')
        ->join('tareas_roles','tareas.id_tarea','=','tareas_roles.id_tarea')
        ->select('funciones.*', 'tareas_roles.id_rol')
        ->where('funciones.estado', '=', 'activo')
        ->where('tareas.estado','=','activo')
        ->groupBy('funciones.id_funcion')
        ->groupBy('tareas_roles.id_rol')
        ->orderBy('tareas_roles.id_rol', 'ASC')
        ->orderBy('funciones.funcion','ASC')->get();
        
        $tareas= DB::table('tareas')
        ->join('tareas_roles','tareas.id_tarea','=','tareas_roles.id_tarea')
        ->select('tareas.*', 'tareas_roles.id_rol')
        ->where('tareas.estado','=','activo')
        ->orderBy('tareas.id_funcion', 'ASC')
        ->orderBy('tareas.tarea','ASC')->get();


        return view('adminlte::funciones.roles', compact('roles','funciones','tareas'));
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

        return view('adminlte::funciones.roles_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolCreateRequest $request)
    {
        $id= Rol::create($request->all());
        return redirect()->route('adminTareasRoles',['id'=>$id]);

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
        ->where('tareas.vista', '=', 'adminRol')->get();
        
        
        if($tarea_valida[0]->cantidad == 0)
            return view('adminlte::errors.404');

        
        $rol = Rol::findOrFail($id);
        return view('adminlte::funciones.roles_edit', compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolUpdateRequest $request, $id)
    {
        $rol = Rol::findOrFail($id);
        $rol->fill($request->all());
        $rol->save();
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TareaRol::where('id_rol',$id)->delete();

        $rol = Rol::findOrFail($id);
        $rol->delete();
        return redirect()->route('roles.index');
    }
}
