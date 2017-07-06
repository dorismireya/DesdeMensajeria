<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerfilUpdateRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use Validator;
use Response;
use App\Modelos\Usuario;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $usuario= auth()->user();

        return view('adminlte::funciones.perfil',compact('usuario'));
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
        //
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
     * funcion para editar el perfil del usuario desde ajax
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function perfilEdit(Request $request){

        
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users,name,'.$request->id.',id',
        ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        else{

            $perfil= Usuario::find($request->id);
            $perfil->name = $request->name;
            $perfil->educacion = $request->educacion;
            $perfil->save();
            return response()->json($perfil);
        }

    }

    /**
     * funcion para editar la biografia del usuario
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function perfilBiografia(Request $request){

        
        $validator = Validator::make($request->all(), [
            'biografia' => 'required',
        ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        else{

            $perfil= Usuario::find($request->id);
            $perfil->biografia = $request->biografia;
            $perfil->log= auth()->id();
            $perfil->save();
            return response()->json($perfil);
        }

    }

    /**
     * funcion para modificar el password
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function perfilPassword(Request $request){

        $current_password= Auth()->user()->password;

        if(Hash::check($request->password, $current_password)){

            $user= Usuario::find($request->id);
            $user->password= $request->new_password;

            $user->save();
            return response()->json($user);
        }else{
            $errors= array('errors'=>'Contraseña incorrecta');
            return response()->json($errors);
        }
    }



    /**
     * Mostrar info del perfil del usuario
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function perfilShow(Request $request){

        $perfil= Usuario::findOrFail($request->id);

        //dd($perfil->name);
        return response()->json($perfil);
    }


}
