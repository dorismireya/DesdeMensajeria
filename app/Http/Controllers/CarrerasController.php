<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modelos\Carrera;
use App\Modelos\Ucw;
use App\Modelos\Ucp;
use Validator;
use Response;

class CarrerasController extends Controller
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
        ->where('tareas.vista', '=', 'sistemaCarrera')->get();
        
        
        if($tarea_valida[0]->cantidad == 0)
            return view('adminlte::errors.404');

        $carreras= DB::table('carreras')
        ->select('carreras.*')
        ->where('carreras.estado', '=', 'activo')
        ->orderBy('carreras.carrera', 'ASC')->paginate(10);

        $estado_consulta= "activo";

        
        return view('adminlte::sistema.carreras',compact('carreras','estado_consulta'));
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
     * Funcion para hacer la busqueda de carreras
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function search(Request $request)
    {

        $tarea_valida= DB::table('tareas')
        ->join('usuarios_tareas','usuarios_tareas.id_tarea','=','tareas.id_tarea')
        ->select(DB::raw('count(tareas.id_tarea) AS cantidad'))
        ->where('usuarios_tareas.id_usuario', '=', Auth()->user()->id)
        ->where('tareas.vista', '=', 'sistemaCarrera')->get();
        
        
        if($tarea_valida[0]->cantidad == 0)
            return view('adminlte::errors.404');

        $param= "%".$request->input('buscar')."%";
        $estado_consulta= $request->input('estado');

        if($estado_consulta != ''){

            $carreras= DB::table('carreras')
            ->select('carreras.*')
            ->where('carreras.estado', '=', $estado_consulta)
            ->where('carreras.carrera', 'like', $param)
            ->orderBy('carreras.carrera', 'ASC')->paginate(10);
        } else{
            $carreras= DB::table('carreras')
            ->select('carreras.*')
            ->where('carreras.estado', '!=', '')
            ->where('carreras.carrera', 'like', $param)
            ->orderBy('carreras.carrera', 'ASC')->paginate(10);
        }
        
        return view('adminlte::sistema.carreras',compact('carreras','estado_consulta'));
    }


    /**
     * funcion para agregar una carrera
     * @param Request $request [description]
     */
    public function carreraAdd(Request $request) {

        $validator = Validator::make($request->all(), [
            'codigo' => 'required|unique:carreras,codigo',
            'carrera' => 'required|unique:carreras,carrera',
        ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        else {
            $carrera= new Carrera();
            $carrera->codigo= $request->codigo;
            $carrera->carrera= $request->carrera;
            $carrera->detalle= $request->detalle;
            $carrera->log= auth()->id();
            $carrera->estado= 'activo';
            $carrera->id_facultad= '1';

            $carrera->save();


            return response()->json($carrera);
      }
    }

    /**
     * Funcion para editar una carrera
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function carreraEdit(Request $request) {

        $validator = Validator::make($request->all(), [
            'codigo' => 'required|unique:carreras,codigo,'.$request->id_carrera.',id_carrera',
            'carrera' => 'required|unique:carreras,carrera,'.$request->id_carrera.',id_carrera',
        ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        else {

            $carrera= Carrera::find($request->id_carrera);
            $carrera->codigo= $request->codigo;
            $carrera->carrera= $request->carrera;
            $carrera->detalle= $request->detalle;
            $carrera->log= auth()->id();
            //$carrera->estado= $request->estado;
            $carrera->id_facultad= '1';

            $carrera->save();


            return response()->json($carrera);
      }
    }

    /**
     * funcion para cambiar el estado de la carrera
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function carreraEstado(Request $request) {

        $validator = Validator::make($request->all(), [
            'estado' => 'required',
        ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        else {

            $carrera= Carrera::find($request->id_carrera);
            $carrera->log= auth()->id();
            $carrera->estado= $request->estado;
            
            $carrera->save();


            return response()->json($carrera);
      }
    }

    /**
     * funcion eliminar carrera
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function carreraDelete(Request $request){

        Ucp::where('id_carrera',$request->id_carrera)->delete();
        Ucw::where('id_carrera',$request->id_carrera)->delete();


        Carrera::find($request->id_carrera)->delete();

        return response()->json();
    }

    /**
     * funcion para retornar la cantidad de materias que tiene la carrera
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function carreraCantidadMaterias(Request $request){

        $cant_materias= DB::table('carreras')
        ->leftJoin('materias','carreras.id_carrera','=','materias.id_carrera')
        ->select(DB::raw('count(materias.id_materia) AS cantidad')) 
        ->where('carreras.id_carrera', '=', $request->id_carrera)
        ->groupBy('carreras.id_carrera')->get();

        return response()->json($cant_materias);
    }
}
