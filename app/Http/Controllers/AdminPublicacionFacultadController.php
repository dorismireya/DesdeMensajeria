<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use App\Modelos\Facultad;
use App\Modelos\Fpublicacion;
use App\Modelos\FtipoPublicacion;
use App\Modelos\Importancia;

class AdminPublicacionFacultadController extends Controller
{
    public function index($id_facultad){

        $facultad_valida= DB::table('users')
        ->join('ufps','users.id','=','ufps.id')
        ->select(DB::raw('count(ufps.id_facultad) AS cantidad'))
        ->where('users.id', '=', Auth()->user()->id)
        ->where('ufps.id_facultad', '=', $id_facultad)->get();

        if($facultad_valida[0]->cantidad == 0)
            return view('adminlte::errors.404');
        
        
        $facultad = Facultad::findOrFail($id_facultad);

        $tipo_publicaciones= DB::table('ftipo_publicaciones')
        ->leftJoin('fpublicaciones', function($join){
            $join->on('ftipo_publicaciones.id_ftp','=','fpublicaciones.id_ftp')
            ->where('fpublicaciones.publicador','=',Auth()->user()->id);
        })
        ->select('ftipo_publicaciones.*', DB::raw('count(fpublicaciones.id_fpublicacion) AS cantidad'))
        ->where('ftipo_publicaciones.estado', '=', 'activo')
        ->groupBy('ftipo_publicaciones.id_ftp')
        ->orderBy('ftipo_publicaciones.posicion', 'ASC')->get();

        $fpublicaciones= DB::table('fpublicaciones')
        ->join('ftipo_publicaciones', 'fpublicaciones.id_ftp', 'ftipo_publicaciones.id_ftp')
        ->join('importancias', 'fpublicaciones.id_importancia', 'importancias.id_importancia')
        ->select('fpublicaciones.*', 'ftipo_publicaciones.tipo AS tipo', 'importancias.importancia AS importancia')
        ->where('fpublicaciones.publicador', '=', Auth()->user()->id)
        ->orderBy('fpublicaciones.id_fpublicacion', 'DESC')->paginate(10);

        $estados= DB::table('fpublicaciones')
        ->select('fpublicaciones.estado AS estado')
        ->groupBy('fpublicaciones.estado')
        ->orderBy('fpublicaciones.estado', 'ASC')->get();

        $importancias= DB::table('importancias')
        ->join('usuarios_importancias', 'importancias.id_importancia', 'usuarios_importancias.id_importancia')
        ->select('importancias.*')
        ->where('importancias.estado', '=', 'activo')
        ->where('usuarios_importancias.id', '=', Auth()->user()->id)
        ->orderBy('importancias.posicion', 'asc')->get();

        $tipos= DB::table('ftipo_publicaciones')
        ->select('ftipo_publicaciones.*')
        ->groupBy('ftipo_publicaciones.tipo')
        ->orderBy('ftipo_publicaciones.tipo', 'ASC')->get();

        $old_search= "";
        $estado_consulta= "";
        $importancia_consulta= "";
        $tipo_consulta= "";


        return view('adminlte::sistema.admin_publicacion_facultad', compact('facultad', 'tipo_publicaciones', 'fpublicaciones', 'estados', 'old_search', 'estado_consulta', 'importancias', 'importancia_consulta', 'tipos', 'tipo_consulta'));
    }


    /**
     * funcion para hacer la busqueda de publicaciones
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function search(Request $request)
    {

        $facultad_valida= DB::table('users')
        ->join('ufps','users.id','=','ufps.id')
        ->select(DB::raw('count(ufps.id_facultad) AS cantidad'))
        ->where('users.id', '=', Auth()->user()->id)
        ->where('ufps.id_facultad', '=', $request->input('id_facultad'))->get();

        if($facultad_valida[0]->cantidad == 0)
            return view('adminlte::errors.404');
        
        
        $facultad = Facultad::findOrFail($request->input('id_facultad'));

        $tipo_publicaciones= DB::table('ftipo_publicaciones')
        ->leftJoin('fpublicaciones', function($join){
            $join->on('ftipo_publicaciones.id_ftp','=','fpublicaciones.id_ftp')
            ->where('fpublicaciones.publicador','=',Auth()->user()->id);
        })
        ->select('ftipo_publicaciones.*', DB::raw('count(fpublicaciones.id_fpublicacion) AS cantidad'))
        ->where('ftipo_publicaciones.estado', '=', 'activo')
        ->groupBy('ftipo_publicaciones.id_ftp')
        ->orderBy('ftipo_publicaciones.posicion', 'ASC')->get();

        $estados= DB::table('fpublicaciones')
        ->select('fpublicaciones.estado AS estado')
        ->groupBy('fpublicaciones.estado')
        ->orderBy('fpublicaciones.estado', 'ASC')->get();

        $importancias= DB::table('importancias')
        ->join('usuarios_importancias', 'importancias.id_importancia', 'usuarios_importancias.id_importancia')
        ->select('importancias.*')
        ->where('importancias.estado', '=', 'activo')
        ->where('usuarios_importancias.id', '=', Auth()->user()->id)
        ->orderBy('importancias.posicion', 'asc')->get();

        $tipos= DB::table('ftipo_publicaciones')
        ->select('ftipo_publicaciones.*')
        ->groupBy('ftipo_publicaciones.tipo')
        ->orderBy('ftipo_publicaciones.tipo', 'ASC')->get();

        $param= "%".$request->input('buscar')."%";
        $old_search= $request->input('buscar');

        $estado_consulta= $request->input('estado');
        $importancia_consulta= $request->input('importancia');
        $tipo_consulta= $request->input('tipo');

        $fpublicaciones= DB::table('fpublicaciones')
            ->join('ftipo_publicaciones', 'fpublicaciones.id_ftp', 'ftipo_publicaciones.id_ftp')
            ->join('importancias', 'fpublicaciones.id_importancia', 'importancias.id_importancia')
            ->select('fpublicaciones.*', 'ftipo_publicaciones.tipo AS tipo', 'importancias.importancia AS importancia')
            ->where('fpublicaciones.publicador', '=', Auth()->user()->id)
            ->where('fpublicaciones.titulo', 'like', $param)
            ->when($estado_consulta != "", function($query) use ($estado_consulta){
                return $query->where('fpublicaciones.estado', $estado_consulta);
            })
            ->when($importancia_consulta != "", function($query) use ($importancia_consulta){
                return $query->where('importancias.importancia', $importancia_consulta);
            })
            ->when($tipo_consulta != "", function($query) use ($tipo_consulta){
                return $query->where('ftipo_publicaciones.tipo', $tipo_consulta);
            })
            ->orderBy('fpublicaciones.id_fpublicacion', 'DESC')->paginate(10);

        
        

        return view('adminlte::sistema.admin_publicacion_facultad', compact('facultad', 'tipo_publicaciones', 'fpublicaciones', 'estados', 'old_search', 'estado_consulta', 'importancias', 'importancia_consulta', 'tipos', 'tipo_consulta'));
    }


    /**
     * funcion para eliminar la publicacion
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function destroy(Request $request)
    {

        $fpublicacion = Fpublicacion::findOrFail($request->id_fpublicacion);
        $fpublicacion->delete();

        return response()->json($fpublicacion);
    }

    /**
     * funcion para retornar la publicacion
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getFpublicacion(Request $request){

        $lista= DB::table('fpublicaciones')
        ->join('ftipo_publicaciones', 'fpublicaciones.id_ftp', 'ftipo_publicaciones.id_ftp')
        ->join('importancias', 'fpublicaciones.id_importancia', 'importancias.id_importancia')
        ->select('fpublicaciones.*', 'ftipo_publicaciones.tipo AS tipo', 'importancias.importancia as importancia')
        ->where('fpublicaciones.id_fpublicacion', '=', $request->id_fpublicacion)->get();

        return response()->json($lista);
    }

    /**
     * funcion para retornar lis lista de tipo de publicaciones, excepto el tipo que ya tiene asignado la publicacion
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function listaCambiarTipo(Request $request){

        $fpublicacion = Fpublicacion::findOrFail($request->id_fpublicacion);

        $lista= DB::table('ftipo_publicaciones')
        ->select('ftipo_publicaciones.*')
        ->where('ftipo_publicaciones.id_ftp', '!=', $fpublicacion->id_ftp)
        ->orderBy('ftipo_publicaciones.tipo', 'asc')->get();

        return response()->json($lista);
    }


    /**
     * funcion para editar el tipo de publicacion
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateTipo(Request $request) {

        $validator = Validator::make($request->all(), [
            'id_fpublicacion' => 'required',
        ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        else {


            $fpublicacion= Fpublicacion::find($request->id_fpublicacion);
            $ftipo_publicacion= FtipoPublicacion::find($request->id_ftp);

            $fpublicacion->id_ftp= $request->id_ftp;
            $fpublicacion->log= auth()->id();

            $fpublicacion->save();

            return response()->json(array('fpublicacion'=>$fpublicacion, 'ftipo_publicacion'=>$ftipo_publicacion));
      }
    }

    /**
     * funcion para listar los estados de posible cambio
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function listaCambiarEstado(Request $request){

        $fpublicacion = Fpublicacion::findOrFail($request->id_fpublicacion);

        $lista= DB::table('fpublicaciones')
        ->select('fpublicaciones.estado as estado')
        ->where('fpublicaciones.estado', '!=', $fpublicacion->estado)
        ->groupBy('fpublicaciones.estado')
        ->orderBy('fpublicaciones.estado', 'asc')->get();

        return response()->json($lista);
    }

    /**
     * funcion para cambir el estado de la publicacion
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateEstado(Request $request) {

        $validator = Validator::make($request->all(), [
            'id_fpublicacion' => 'required',
        ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        else {


            $fpublicacion= Fpublicacion::find($request->id_fpublicacion);

            $fpublicacion->estado= $request->estado;
            $fpublicacion->log= auth()->id();

            $fpublicacion->save();

            return response()->json($fpublicacion);
      }
    }

    /**
     * funcion para listas los tipos de importancia
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function listaCambiarImportancia(Request $request){

        $fpublicacion = Fpublicacion::findOrFail($request->id_fpublicacion);

        $lista= DB::table('importancias')
        ->join('usuarios_importancias', 'importancias.id_importancia', 'usuarios_importancias.id_importancia')
        ->select('importancias.*')
        ->where('importancias.id_importancia', '!=', $fpublicacion->id_importancia)
        ->where('importancias.estado', '=', 'activo')
        ->where('usuarios_importancias.id', '=', Auth()->user()->id)
        ->orderBy('importancias.posicion', 'asc')->get();

        return response()->json($lista);
    }

    /**
     * funcion para modificar la importancia de una publicacion
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateImportancia(Request $request) {

        $validator = Validator::make($request->all(), [
            'id_fpublicacion' => 'required',
        ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        else {


            $fpublicacion= Fpublicacion::find($request->id_fpublicacion);
            $importancia= Importancia::find($request->id_importancia);

            $fpublicacion->id_importancia= $request->id_importancia;
            $fpublicacion->log= auth()->id();

            $fpublicacion->save();

            return response()->json(array('fpublicacion'=>$fpublicacion, 'importancia'=>$importancia));
      }
    }

    /**
     * funcion para editar la fecha
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateFecha(Request $request) {

        $validator = Validator::make($request->all(), [
            'id_fpublicacion' => 'required',
        ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        else {


            $fpublicacion= Fpublicacion::find($request->id_fpublicacion);

            $fpublicacion->fecha_inicio= $request->fecha_inicio;
            $fpublicacion->fecha_fin= $request->fecha_fin;

            $fpublicacion->log= auth()->id();

            $fpublicacion->save();

            return response()->json($fpublicacion);
      }
    }
}
