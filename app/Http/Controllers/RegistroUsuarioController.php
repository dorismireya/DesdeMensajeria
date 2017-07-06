<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modelos\Usuario;
use App\Modelos\Rol;
use App\Modelos\UsuarioTarea;

class RegistroUsuarioController extends Controller
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
        ->where('tareas.vista', '=', 'adminRegistrosUsuarios')->get();
        
        
        if($tarea_valida[0]->cantidad == 0)
            return view('adminlte::errors.404');

        $usuarios= DB::table('users')
        ->select('users.*')
        ->whereNull('users.estado')
        ->orderBy('users.name', 'ASC')->paginate(10);

        $roles= DB::table('roles')
        ->select('roles.*')
        ->where('roles.estado', '=', 'activo')
        ->orderBy('roles.rol', 'ASC')->get();

        
        return view('adminlte::funciones.registro_usuario',compact('usuarios','roles'));
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
        
    }

    /**
     * funcion para activar los usuarios de la base de datos
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function activarUsuario(Request $request)
    {
        $rol= Rol::findOrFail($request->id_rol);

        $usuario= DB::table('users')->where('id',$request->id)->update(['tipo' => $rol->rol]);
        $usuario= DB::table('users')->where('id',$request->id)->update(['estado' => 'activo']);

        $user= Usuario::findOrFail($request->id);

        
        $tr= DB::table('tareas_roles')->select('tareas_roles.*')->where('tareas_roles.id_rol', '=', $rol->id_rol)->get();


        if(count($tr)!= 0){

            $array;

            for($i=0; $i < count($tr); $i++) { 

            
                $array[$i]= ['id_tarea'=>$tr[$i]->id_tarea, 'id_usuario'=>$request->id];   
            }


            UsuarioTarea::insert($array);
        }

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    /**
     * funcion para eliminar un usuario de la base de datos
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function eliminarUsuario(Request $request)
    {
        $user = Usuario::findOrFail($request->id);
        $user->delete();

        return response()->json($user);
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
        ->where('tareas.vista', '=', 'adminRegistrosUsuarios')->get();
        
        
        if($tarea_valida[0]->cantidad == 0)
            return view('adminlte::errors.404');

        $param= "%".$request->input('buscar')."%";
        
        
        $usuarios= DB::table('users')
        ->select('users.*')
        ->where('users.estado', '=', '')
        ->where('users.name', 'like', $param)
        ->orderBy('users.name', 'ASC')->paginate(10);
        
        

        $roles= DB::table('roles')
        ->select('roles.*')
        ->where('roles.estado', '=', 'activo')
        ->orderBy('roles.rol', 'ASC')->get();

        return view('adminlte::funciones.registro_usuario',compact('usuarios', 'roles'));
    }
}
