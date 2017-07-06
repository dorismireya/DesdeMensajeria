<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Modelos\Carrera;
use App\Modelos\Facultad;
use App\Modelos\File;

class AdminWebCarreraController extends Controller
{
    public function index($id_carrera){

        $carrera_valida= DB::table('users')
        ->join('ucws','users.id','=','ucws.id')
        ->select(DB::raw('count(ucws.id_carrera) AS cantidad'))
        ->where('users.id', '=', Auth()->user()->id)
        ->where('ucws.id_carrera', '=', $id_carrera)->get();

        if($carrera_valida[0]->cantidad == 0)
            return view('adminlte::errors.404');
        
        
        $carrera = Carrera::findOrFail($id_carrera);

        $carruseles= DB::table('files')
        ->select('files.*')
        ->where('files.tabla', '=', 'carrera')
        ->where('files.id_tabla', '=', $id_carrera)
        ->where('files.estado', '=', 'activo')
        ->orderBy('files.id_file', 'asc')->get();


        return view('adminlte::sistema.admin_web_carrera', compact('carrera', 'carruseles'));
    }

    /**
     * funcion para subir logo de carrera
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function adminWebCarrera_logo(Request $request){

        //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        $validator = Validator::make($request->all(), [
            'id_carrera' => 'required',
                
            ]);


        
      if ($validator->fails()) 
        return Response::json(array('errors'=> $validator->getMessageBag()->toArray()));
    else{

        $carrera= Carrera::find($request->id_carrera);

        $path_image= time().'.'.$request->image->getClientOriginalExtension();

        $carrera->logo= 'web/'.$path_image;
        $request->image->move(public_path('web'), $path_image);

        $carrera->save();

        return redirect()->route('adminWebCarrera',['id_carrera' => $request->id_carrera]);
      }

    }


    public function adminWebCarrera_carrusel(Request $request){

        //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        $validator = Validator::make($request->all(), [
            'id_carrera' => 'required',
                
            ]);


        
      if ($validator->fails()) 
        return Response::json(array('errors'=> $validator->getMessageBag()->toArray()));
    else{

        $carrera= Carrera::find($request->id_carrera);
        $file= new File();

        $path_image= time().'.'.$request->image->getClientOriginalExtension();

        $file->titulo= $carrera->carrera;
        $file->detalle= 'carrusel '.$carrera->carrera;
        $file->direccion= 'web/'.$path_image;
        $file->tabla= 'carrera';
        $file->id_tabla= $request->id_carrera;
        $file->estado= 'activo';
        $file->log= auth()->id();

        $request->image->move(public_path('web'), $path_image);

        $file->save();

        return redirect()->route('adminWebCarrera',['id_carrera' => $request->id_carrera]);
      }

    }

    /**
     * eliminar archivo
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function destroy_file(Request $request){


        $file= File::findOrFail($request->id_file);

        Storage::delete($file->direccion);

        $file->delete();

        return response()->json($file);
    }

    /**
     * funcion para editar datos de carrera
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function adminWebCarrera_edit(Request $request){

        
        $validator = Validator::make($request->all(), [
            'codigo' => 'required',
            'carrera' => 'required|unique:carreras,carrera,'.$request->id_carrera.',id_carrera', 
        ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        else{

            $carrera= Carrera::find($request->id_carrera);
            $carrera->codigo = $request->codigo;
            $carrera->carrera = $request->carrera;
            
            $carrera->log= auth()->id();

            $carrera->save();

            return response()->json($carrera);
        }

    }

    /**
     * funcion para editar campos
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function adminWebCarrera_campos(Request $request){

        $validator = Validator::make($request->all(), [
                'id_carrera' => 'required',
            ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        else{

            $carrera= Carrera::find($request->id_carrera);
            if($request->variable == "mision")
                $carrera->mision = $request->contenido;

            if($request->variable == "vision")
                $carrera->vision = $request->contenido;

            if($request->variable == "proyeccion")
                $carrera->proyeccion = $request->contenido;

            if($request->variable == "descripcion")
                $carrera->detalle = $request->contenido;

            if($request->variable == "autoridad")
                $carrera->autoridad = $request->contenido;
            
            $carrera->log= auth()->id();
            $carrera->save();
            
            return response()->json($carrera);
        }

    }
}
