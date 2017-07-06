<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Modelos\Facultad;
use App\Modelos\FtipoPublicacion;
use App\Modelos\Importancia;
use App\Modelos\File;

class AdminWebFacultadController extends Controller
{
    public function index($id_facultad){

        $facultad_valida= DB::table('users')
        ->join('ufws','users.id','=','ufws.id')
        ->select(DB::raw('count(ufws.id_facultad) AS cantidad'))
        ->where('users.id', '=', Auth()->user()->id)
        ->where('ufws.id_facultad', '=', $id_facultad)->get();

        if($facultad_valida[0]->cantidad == 0)
            return view('adminlte::errors.404');
        
        
        $facultad = Facultad::findOrFail($id_facultad);

        $tipo_publicaciones= DB::table('ftipo_publicaciones')
        ->select('ftipo_publicaciones.*')
        ->orderBy('ftipo_publicaciones.estado', 'ASC')
        ->orderBy('ftipo_publicaciones.posicion', 'ASC')->get();


        $importancias= DB::table('importancias')
        ->select('importancias.*')
        ->orderBy('importancias.estado', 'ASC')
        ->orderBy('importancias.posicion', 'ASC')->get();

        $carruseles= DB::table('files')
        ->select('files.*')
        ->where('files.tabla', '=', 'facultad')
        ->where('files.id_tabla', '=', $id_facultad)
        ->where('files.estado', '=', 'activo')
        ->orderBy('files.id_file', 'asc')->get();

        return view('adminlte::sistema.admin_web_facultad', compact('facultad', 'tipo_publicaciones', 'importancias', 'carruseles'));
    }

    /**
     * funcion para editar los datos de la facultad
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function adminWebFacultad_edit(Request $request){

        
        $validator = Validator::make($request->all(), [
            'facultad' => 'required|unique:facultades,facultad,'.$request->id_facultad.',id_facultad',
            'universidad' => 'required',
        ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        else{

            $facultad= Facultad::find($request->id_facultad);
            $facultad->facultad = $request->facultad;
            $facultad->universidad = $request->universidad;
            $facultad->telefono = $request->telefono;
            $facultad->fax = $request->fax;
            $facultad->direccion = $request->direccion;

            $facultad->log= auth()->id();

            $facultad->save();

            return response()->json($facultad);
        }

    }

    /**
     * funcion para editar campos
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function adminWebFacultad_campos(Request $request){

    	$validator = Validator::make($request->all(), [
            	'id_facultad' => 'required',
        	]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        else{

            $facultad= Facultad::find($request->id_facultad);
            if($request->variable == "mision")
            	$facultad->mision = $request->contenido;

            if($request->variable == "vision")
            	$facultad->vision = $request->contenido;

            if($request->variable == "historia")
            	$facultad->historia = $request->contenido;

            if($request->variable == "descripcion")
                $facultad->detalle = $request->contenido;

            if($request->variable == "autoridad")
            	$facultad->autoridad = $request->contenido;
            
            $facultad->log= auth()->id();
            $facultad->save();
            
            return response()->json($facultad);
        }

    }


    /**
     * funcion para agregar un logo a la facultad
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function adminWebFacultad_logo(Request $request){

        //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        $validator = Validator::make($request->all(), [
            'id_facultad' => 'required',
                
            ]);


        
      if ($validator->fails()) 
        return Response::json(array('errors'=> $validator->getMessageBag()->toArray()));
    else{

        $facultad= Facultad::find($request->id_facultad);

        $path_image= time().'.'.$request->image->getClientOriginalExtension();

        $facultad->logo= 'web/'.$path_image;
        $request->image->move(public_path('web'), $path_image);

        $facultad->save();

        return redirect()->route('adminWebFacultad',['id_facultad' => $request->id_facultad]);
      }

    }

    public function adminWebFacultad_carrusel(Request $request){

        //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        $validator = Validator::make($request->all(), [
            'id_facultad' => 'required',
                
            ]);


        
      if ($validator->fails()) 
        return Response::json(array('errors'=> $validator->getMessageBag()->toArray()));
    else{

        $facultad= Facultad::find($request->id_facultad);
        $file= new File();

        $path_image= time().'.'.$request->image->getClientOriginalExtension();

        $file->titulo= $facultad->facultad;
        $file->detalle= 'carrusel '.$facultad->facultad;
        $file->direccion= 'web/'.$path_image;
        $file->tabla= 'facultad';
        $file->id_tabla= $request->id_facultad;
        $file->estado= 'activo';
        $file->log= auth()->id();

        $request->image->move(public_path('web'), $path_image);

        $file->save();

        return redirect()->route('adminWebFacultad',['id_facultad' => $request->id_facultad]);
      }

    }

    /**
     * Funcion para crear un nuevo tipo de publicacion
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function admimWebFacultad_TipoPublicacionAdd(Request $request) {

        $validator = Validator::make($request->all(), [
            'tipo' => 'required|unique:ftipo_publicaciones,tipo',
            'detalle' => 'required',
        ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        else {

            $posiciones= DB::table('ftipo_publicaciones')
            ->select(DB::raw('IFNULL(max(ftipo_publicaciones.posicion)+1, 1) AS posicion'))->get();


            $tipo_publicacion= new FtipoPublicacion();
            $tipo_publicacion->tipo= $request->tipo;
            $tipo_publicacion->detalle= $request->detalle;
            $tipo_publicacion->estado= "activo";
            $tipo_publicacion->posicion= $posiciones[0]->posicion;
            $tipo_publicacion->log= auth()->id();

            $tipo_publicacion->save();


            return response()->json($tipo_publicacion);
      }
    }


    /**
     * Funcion para editar el tipo de publicacion
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function admimWebFacultad_TipoPublicacionEdit(Request $request) {

        $validator = Validator::make($request->all(), [
            'tipo' => 'required|unique:ftipo_publicaciones,tipo,'.$request->id_ftp.',id_ftp',
            'detalle' => 'required',
        ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        else {

            $tipo_publicacion= FtipoPublicacion::find($request->id_ftp);

            $tipo_publicacion->tipo= $request->tipo;
            $tipo_publicacion->detalle= $request->detalle;
            $tipo_publicacion->log= auth()->id();

            $tipo_publicacion->save();


            return response()->json($tipo_publicacion);
      }
    }


    /**
     * Funcion para cambiar estado del tipo publicacion
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function admimWebFacultad_TipoPublicacionEstado(Request $request) {

        $validator = Validator::make($request->all(), [
            'estado' => 'required',
        ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        else {

            $tipo_publicacion= FtipoPublicacion::find($request->id_ftp);

            $tipo_publicacion->estado= $request->estado;
            $tipo_publicacion->log= auth()->id();

            $tipo_publicacion->save();


            return response()->json($tipo_publicacion);
      }
    }


    /**
     * Funcion para retorar la lista de tipos de publicacion
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function adminWebFacultad_ListaTipoPublicacion(Request $request){

        $lista= DB::table('ftipo_publicaciones')
        ->select('ftipo_publicaciones.*') 
        ->where('ftipo_publicaciones.id_ftp', '!=', $request->id_ftp)
        ->where('ftipo_publicaciones.estado', '=', 'activo')
        ->orderBy('ftipo_publicaciones.posicion', 'ASC')->get();

        return response()->json($lista);
    }


    /**
     * funcion para intercambiar posiciones
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function admimWebFacultad_TipoPublicacionPosicion(Request $request) {

        $validator = Validator::make($request->all(), [
            'id_ftp' => 'required',
        ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        else {


            $tipo_publicacion= FtipoPublicacion::find($request->id_ftp);
            $tipo_new_publicacion= FtipoPublicacion::find($request->new_id_ftp);


            $temp_pos= $tipo_publicacion->posicion;

            $tipo_publicacion->posicion= $tipo_new_publicacion->posicion;
            $tipo_publicacion->log= auth()->id();

            $tipo_publicacion->save();


            $tipo_new_publicacion->posicion= $temp_pos;
            $tipo_new_publicacion->log= auth()->id();

            $tipo_new_publicacion->save();



            return response()->json(array('tipo_publicacion'=>$tipo_publicacion, 'tipo_new_publicacion'=>$tipo_new_publicacion));
      }
    }


    /**
     * funcion para adicionar la importancia
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function admimWebFacultad_ImportanciaAdd(Request $request) {

        $validator = Validator::make($request->all(), [
            'importancia' => 'required|unique:importancias,importancia',
        ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        else {

            $posiciones= DB::table('importancias')
            ->select(DB::raw('IFNULL(max(importancias.posicion)+1, 1) AS posicion'))->get();


            $importancia= new Importancia();
            $importancia->importancia= $request->importancia;
            $importancia->estado= "activo";
            $importancia->posicion= $posiciones[0]->posicion;
            $importancia->log= auth()->id();

            $importancia->save();


            return response()->json($importancia);
      }
    }


    /**
     * funcion para editar importancia
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function admimWebFacultad_ImportanciaEdit(Request $request) {

        $validator = Validator::make($request->all(), [
            'importancia' => 'required|unique:importancias,importancia,'.$request->id_importancia.',id_importancia',
        ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        else {

            $importancia= Importancia::find($request->id_importancia);

            $importancia->importancia= $request->importancia;
            $importancia->log= auth()->id();

            $importancia->save();


            return response()->json($importancia);
      }
    }

    /**
     * funcion para editar el estado de importancia
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function admimWebFacultad_ImportanciaEstado(Request $request) {

        $validator = Validator::make($request->all(), [
            'estado' => 'required',
        ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        else {

            $importancia= Importancia::find($request->id_importancia);

            $importancia->estado= $request->estado;
            $importancia->log= auth()->id();

            $importancia->save();


            return response()->json($importancia);
      }
    }

    /**
     * funcion para listas importancia
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function adminWebFacultad_ListaImportancia(Request $request){

        $lista= DB::table('importancias')
        ->select('importancias.*') 
        ->where('importancias.id_importancia', '!=', $request->id_importancia)
        ->where('importancias.estado', '=', 'activo')
        ->orderBy('importancias.posicion', 'ASC')->get();

        return response()->json($lista);
    }


    public function admimWebFacultad_ImportanciaPosicion(Request $request) {

        $validator = Validator::make($request->all(), [
            'id_importancia' => 'required',
        ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        else {


            $importancia= Importancia::find($request->id_importancia);
            $new_importancia= Importancia::find($request->new_id_importancia);


            $temp_pos= $importancia->posicion;

            $importancia->posicion= $new_importancia->posicion;
            $importancia->log= auth()->id();

            $importancia->save();


            $new_importancia->posicion= $temp_pos;
            $new_importancia->log= auth()->id();

            $new_importancia->save();



            return response()->json(array('importancia'=>$importancia, 'new_importancia'=>$new_importancia));
      }
    }
}
