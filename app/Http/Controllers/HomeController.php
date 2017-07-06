<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use Response;
use Carbon\Carbon;
use App\Modelos\Mensaje;
use App\Modelos\MensajeDestino;
use App\Modelos\Usuario;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {        
        return view('adminlte::home');
    }

    /**
     * Listar usuarios del sistema de administracion
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function listar_usuarios_mensaje(Request $request){

        $usuario= Usuario::find(Auth()->user()->id);

        $lista= DB::table('users')
        ->select('users.*')
        ->where('users.estado', '=', 'activo')
        ->where('users.id', '!=', Auth()->user()->id)
        ->orderBy('users.name', 'asc')->get();

        $mensaje= DB::table('mensajes')
        ->join('mensajes_destinos', 'mensajes.id_mensaje', 'mensajes_destinos.id_mensaje')
        ->join('users', 'mensajes_destinos.id_destino', 'users.id')
        ->select('mensajes.*','mensajes_destinos.id_destino as id_destino', 'users.name as name')
        ->where('mensajes.id_mensaje', '=', $request->id_mensaje)->get();

        return response()->json(array('lista'=>$lista, 'usuario'=>$usuario, 'mensaje'=>$mensaje));
    }

    public function guardar_usuarios_mensaje(Request $request){

        //dd($request->all);
        $validator = Validator::make($request->all(), [
            'asunto' => 'required',
        ]);


        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        else {

            $mensaje= new Mensaje();

            $mensaje->asunto= $request->asunto;
            $mensaje->mensaje= $request->mensaje;
            $mensaje->fecha= Carbon::now();
            $mensaje->id_origen= auth()->id();
            $mensaje->estado= 'activo';
            $mensaje->log= auth()->id();
            
            $mensaje->save();

            for($i=0; $i < count($request->lista); $i++){

                $mensajes_destinos= new MensajeDestino();

                $mensajes_destinos->id_mensaje= $mensaje->id_mensaje;
                $mensajes_destinos->id_destino= $request->lista[$i];
                $mensajes_destinos->visto= 'no';

                $mensajes_destinos->save();


                $usuario = Usuario::findOrFail($request->lista[$i]);

                $content = [
                    'title' => $mensaje->asunto,
                    'body' => $mensaje->mensaje
                ];

                $receiverAddress= $usuario->email;

                Mail::to($receiverAddress)->send(new OrderShipped($content));
            }


            return response()->json($mensaje);
        }
    }


    /**
     * listar todos los mensajes que no se an visto
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function listar_mensajes(Request $request){

        $tarea_valida= DB::table('tareas')
        ->join('usuarios_tareas','usuarios_tareas.id_tarea','=','tareas.id_tarea')
        ->select(DB::raw('count(tareas.id_tarea) AS cantidad'))
        ->where('usuarios_tareas.id_usuario', '=', Auth()->user()->id)
        ->where('tareas.vista', '=', 'adminRegistrosUsuarios')->get();

        $usuarios= DB::table('users')
        ->select('users.*')
        ->whereNull('users.estado')
        ->orderBy('users.id', 'DESC')->get();

        $lista= DB::table('mensajes')
        ->join('mensajes_destinos', 'mensajes.id_mensaje', 'mensajes_destinos.id_mensaje')
        ->join('users', 'mensajes.id_origen', 'users.id')
        ->select('mensajes.*', 'users.name as name', 'mensajes_destinos.id_md as id_md')
        ->where('mensajes.estado', '=', 'activo')
        ->where('mensajes_destinos.visto', '=', 'no')
        ->where('mensajes_destinos.id_destino', '=', Auth()->user()->id)
        ->orderBy('mensajes.fecha', 'desc')->get();

        return response()->json(array('lista'=>$lista, 'tarea_valida'=>$tarea_valida, 'usuarios'=>$usuarios));
    }

    /**
     * poner en vista al mensaje
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateVisto(Request $request) {

        $validator = Validator::make($request->all(), [
            'id_md' => 'required',
        ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        else {


            $mensaje_destino= MensajeDestino::find($request->id_md);

            $mensaje_destino->visto= 'si';

            $mensaje_destino->save();

            return response()->json($mensaje_destino);
      }
    }

}