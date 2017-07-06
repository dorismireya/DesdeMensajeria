<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modelos\Facultad;
use App\Modelos\Usuario;
use App\Modelos\Visita;
use Carbon\Carbon;
use stevebauman\location;

class IndexController extends Controller
{
    /**
	 * funcion para iniciar el modulo web
	 * @return [type] [description]
	 */
    public function index(){


    	$facultad = Facultad::findOrFail(1);

    	$carreras= DB::table('carreras')
        ->select('carreras.*')
        ->where('carreras.estado','=','activo')
        ->where('id_facultad','=',$facultad->id_facultad)
        ->orderBy('carreras.carrera','ASC')->get();

        $tipo_publicaciones= DB::table('ftipo_publicaciones')
        ->select('ftipo_publicaciones.*')
        ->where('ftipo_publicaciones.estado', '=', 'activo')
        ->orderBy('ftipo_publicaciones.posicion', 'ASC')->get();

        $nuevas_publicaciones= DB::table('fpublicaciones')
        ->join('ftipo_publicaciones', 'fpublicaciones.id_ftp', 'ftipo_publicaciones.id_ftp')
        ->select('fpublicaciones.*', 'ftipo_publicaciones.tipo as tipo')
        ->where('fpublicaciones.estado', '=', 'publicado')
        ->orderBy('fpublicaciones.id_fpublicacion', 'desc')
        ->limit(9)->get();

        $tag_html="";

        foreach ($tipo_publicaciones as $tp) {

            $publicaciones= DB::table('fpublicaciones')
            ->join('importancias', 'fpublicaciones.id_importancia', 'importancias.id_importancia')
            ->select('fpublicaciones.*')
            ->where('fpublicaciones.estado', '=', 'publicado')
            ->where('fpublicaciones.tabla', '=', 'facultad')
            ->where('fpublicaciones.id_tabla', '=', $facultad->id_facultad)
            ->where('fpublicaciones.id_ftp', '=', $tp->id_ftp)
            ->where('fpublicaciones.fecha_fin', '>=', DB::raw('curdate()'))
            ->orderBy('importancias.posicion', 'asc')
            ->orderBy('fpublicaciones.fecha_fin', 'asc')
            ->orderBy('fpublicaciones.id_fpublicacion', 'asc')
            ->limit(4)->get();

            //dd($publicaciones);
            
            $tag_html= $tag_html."<div class='tab-pane fade' id='".$tp->tipo."'>";
            $tag_html= $tag_html."<ul class='news_tab'>";

            foreach ($publicaciones as $pos => $publicacion) {

                $tag_html= $tag_html."<li>";
                $tag_html= $tag_html."<div class='media'>";
                $tag_html= $tag_html."<div class='media-body'>";
                $tag_html= $tag_html."<a href='".route('publicacion_completa',['id_fpublicacion'=>$publicacion->id_fpublicacion])."'>".$publicacion->titulo."'</a>";
                $tag_html= $tag_html."<span class='feed_detalle'>".$publicacion->detalle."</span><br>";
                $tag_html= $tag_html."<span class='feed_date'>Del: ".Carbon::parse($publicacion->fecha_inicio)->format('d/m/Y')." al: ".Carbon::parse($publicacion->fecha_fin)->format('d/m/Y')."</span>";
                $tag_html= $tag_html."</div>";
                $tag_html= $tag_html."</div>";
                $tag_html= $tag_html."</li>";

            }

            $tag_html= $tag_html."</ul>";
            $tag_html= $tag_html."<a class='see_all' href='".route('publicacion',['id_ftp'=>$tp->id_ftp])."'>Mostrar todos</a>";
            $tag_html= $tag_html."</div>";
        }


    	return view('index', compact('facultad', 'carreras', 'tipo_publicaciones', 'nuevas_publicaciones', 'tag_html'));
    }


    /**
     * funcion para retornar la cantidad de publicaciones especiales
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getCantidad_Publicaciones(Request $request){

        $cantidad= DB::table('fpublicaciones')
        ->join('ftipo_publicaciones', 'fpublicaciones.id_ftp', 'ftipo_publicaciones.id_ftp')
        ->join('importancias', 'fpublicaciones.id_importancia', 'importancias.id_importancia')
        ->select(DB::raw('count(fpublicaciones.id_fpublicacion) AS cantidad'))
        ->where('ftipo_publicaciones.tipo', '=', $request->tipo)
        ->where('importancias.importancia', '=', $request->importancia)
        ->where('fpublicaciones.fecha_inicio', '<=', DB::raw('curdate()'))
        ->where('fpublicaciones.fecha_fin', '>=', DB::raw('curdate()'))
        ->where('fpublicaciones.estado', '=', 'publicado')->get();

        return response()->json($cantidad);
    }


    /**
     * funcion para retornar una lista de publicaciones especiales
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getLoad_Publicaciones(Request $request){

        //dd($request->ip());
        //dd(\Location::get($request->ip()));
        //dd(\Location::get('200.58.76.207'));
        $lista= DB::table('fpublicaciones')
        ->join('ftipo_publicaciones', 'fpublicaciones.id_ftp', 'ftipo_publicaciones.id_ftp')
        ->join('importancias', 'fpublicaciones.id_importancia', 'importancias.id_importancia')
        ->select('fpublicaciones.*')
        ->where('ftipo_publicaciones.tipo', '=', $request->tipo)
        ->where('importancias.importancia', '=', $request->importancia)
        ->where('fpublicaciones.fecha_inicio', '<=', DB::raw('curdate()'))
        ->where('fpublicaciones.fecha_fin', '>=', DB::raw('curdate()'))
        ->where('fpublicaciones.estado', '=', 'publicado')
        ->orderBy('fpublicaciones.fecha_fin', 'asc')->get();

        $nombre_visitante= "";
        $localizacion= \Location::get($request->ip());

        if(Auth()->user() != null){

            $u = Usuario::findOrFail(Auth()->user()->id);
            $nombre_visitante= $u->name;
        }

        //dd(\Location::get('200.58.76.207'));

        foreach ($lista as $key => $l) {

            $visita= new Visita();

            $visita->visita= $nombre_visitante;
            $visita->id_fpublicacion= $l->id_fpublicacion;
            $visita->ciudad= $localizacion->cityName;
            $visita->ip= $request->ip();
            $visita->fecha= Carbon::now();

            $visita->save();
        }

        return response()->json($lista);
    }
}
