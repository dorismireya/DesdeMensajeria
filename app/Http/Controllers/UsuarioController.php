<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modelos\Usuario;
use App\Modelos\Rol;
use App\Modelos\UsuarioTarea;

class UsuarioController extends Controller
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
        ->where('tareas.vista', '=', 'adminUsuario')->get();
        
        
        if($tarea_valida[0]->cantidad == 0)
            return view('adminlte::errors.404');


        $usuarios= DB::table('users')
        ->select('users.*')
        ->where('users.estado', '=', 'activo')
        ->orderBy('users.name', 'ASC')->paginate(10);

        $roles= DB::table('roles')
        ->select('roles.*')
        ->where('roles.estado', '=', 'activo')
        ->orderBy('roles.rol', 'ASC')->get();

        $estado_consulta= "activo";

        return view('adminlte::funciones.usuarios',compact('usuarios','roles','estado_consulta'));
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

        $usuario = Usuario::findOrFail($id);
        $usuario->fill($request->all());
        $usuario->save();
        return redirect()->route('usuarios.index');
    }


    /**
     * Funcion para cambiar el rol del usuario
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update_rol(Request $request, $id)
    {

        $rol= Rol::findOrFail($request->input('tipo'));

        $usuario= DB::table('users')->where('id',$id)->update(['tipo' => $rol->rol]);

        UsuarioTarea::where('id_usuario',$id)->delete();

        $tr= DB::table('tareas_roles')->select('tareas_roles.*')->where('tareas_roles.id_rol', '=', $rol->id_rol)->get();


        if(count($tr)!= 0){

            $array;

            for($i=0; $i < count($tr); $i++) { 

            
                $array[$i]= ['id_tarea'=>$tr[$i]->id_tarea, 'id_usuario'=>$id];   
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


    /**
     * Funcion para hacer la busqueda de usuarios
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function search(Request $request)
    {

        $tarea_valida= DB::table('tareas')
        ->join('usuarios_tareas','usuarios_tareas.id_tarea','=','tareas.id_tarea')
        ->select(DB::raw('count(tareas.id_tarea) AS cantidad'))
        ->where('usuarios_tareas.id_usuario', '=', Auth()->user()->id)
        ->where('tareas.vista', '=', 'adminUsuario')->get();
        
        
        if($tarea_valida[0]->cantidad == 0)
            return view('adminlte::errors.404');

        $param= "%".$request->input('buscar')."%";
        $estado_consulta= $request->input('estado');
        
        if($estado_consulta != ''){

            $usuarios= DB::table('users')
            ->select('users.*')
            ->where('users.estado', '=', $estado_consulta)
            ->where('users.name', 'like', $param)
            ->orderBy('users.name', 'ASC')->paginate(10);    
        } else{

            $usuarios= DB::table('users')
            ->select('users.*')
            ->where('users.estado', '!=', '')
            ->where('users.name', 'like', $param)
            ->orderBy('users.name', 'ASC')->paginate(10);
        }
        

        $roles= DB::table('roles')
        ->select('roles.*')
        ->where('roles.estado', '=', 'activo')
        ->orderBy('roles.rol', 'ASC')->get();

        return view('adminlte::funciones.usuarios',compact('usuarios', 'roles', 'estado_consulta'));
    }
}
