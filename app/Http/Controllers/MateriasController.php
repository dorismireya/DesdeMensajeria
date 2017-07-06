<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Modelos\Carrera;
use App\Modelos\Materia;
use App\Modelos\Dependencia;
use Validator;
use Response;

class MateriasController extends Controller
{
    public function index1($id_carrera){


    	$tarea_valida= DB::table('tareas')
        ->join('usuarios_tareas','usuarios_tareas.id_tarea','=','tareas.id_tarea')
        ->select(DB::raw('count(tareas.id_tarea) AS cantidad'))
        ->where('usuarios_tareas.id_usuario', '=', Auth()->user()->id)
        ->where('tareas.vista', '=', 'sistemaCarrera')->get();
        
        
        if($tarea_valida[0]->cantidad == 0)
            return view('adminlte::errors.404');

    	$carrera= Carrera::find($id_carrera);

        $materias= DB::table('materias')
        ->leftJoin('dependencias','materias.id_materia','=','dependencias.id_materia')
        ->select('materias.*', DB::raw('count(dependencias.id_dependencia) AS cantidad'))
        ->where('materias.estado', '=', 'activo')
        ->where('materias.id_carrera', '=', $id_carrera)
        ->groupBy('materias.id_materia')
        ->orderBy('materias.nivel', 'ASC')
        ->orderBy('materias.codigo', 'ASC')->paginate(10);

        $estado_consulta= "activo";

    	return view('adminlte::sistema.materias', compact('carrera','materias','estado_consulta'));
    }

    /**
     * Funcion para hacer la busqueda de materias
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

        $id_carrera= $request->input('id_carrera');

        $carrera= Carrera::find($id_carrera);
        
        $param= "%".$request->input('buscar')."%";
        $estado_consulta= $request->input('estado');


        if($estado_consulta != ''){

            $materias= DB::table('materias')
            ->leftJoin('dependencias','materias.id_materia','=','dependencias.id_materia')
            ->select('materias.*', DB::raw('count(dependencias.id_dependencia) AS cantidad'))
            ->where('materias.id_carrera', '=', $id_carrera)
            ->where('materias.estado', '=', $estado_consulta)
            ->where('materias.materia', 'like', $param)
            ->groupBy('materias.id_materia')
            ->orderBy('materias.nivel', 'ASC')
            ->orderBy('materias.materia')->paginate(10);
        } else{
            $materias= DB::table('materias')
            ->leftJoin('dependencias','materias.id_materia','=','dependencias.id_materia')
            ->select('materias.*', DB::raw('count(dependencias.id_dependencia) AS cantidad'))
            ->where('materias.id_carrera', '=', $id_carrera)
            ->where('materias.estado', '!=', '')
            ->where('materias.materia', 'like', $param)
            ->groupBy('materias.id_materia')
            ->orderBy('materias.nivel', 'ASC')
            ->orderBy('materias.codigo', 'ASC')->paginate(10);
        }
        
        return view('adminlte::sistema.materias',compact('carrera','materias','estado_consulta'));
    }


    /**
     * funcion para agregar una materia
     * @param Request $request [description]
     */
    public function materiaAdd(Request $request) {

        $validator = Validator::make($request->all(), [
            'materia' => [
            	'required',
            	Rule::unique('materias','materia')->where('id_carrera',$request->id_carrera),
            	],

            'nivel' => 'required',

            'codigo' => [
            	'required',
            	Rule::unique('materias','codigo')->where('id_carrera',$request->id_carrera),
            	],

            'sigla' => [
            	'required',
            	Rule::unique('materias','sigla')->where('id_carrera',$request->id_carrera),
            	],
        ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        else {
            $materia= new Materia();

            $materia->id_carrera= $request->id_carrera;
            $materia->materia= $request->materia;
            $materia->nivel= $request->nivel;
            $materia->codigo= $request->codigo;
            $materia->sigla= $request->sigla;
            $materia->detalle= $request->detalle;
            $materia->log= auth()->id();
            $materia->estado= 'activo';
            
            $materia->save();


            return response()->json($materia);
        }
    }

    /**
     * funcion para editar una materia
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function materiaEdit(Request $request) {

        $validator = Validator::make($request->all(), [
            'materia' => [
            	'required',
            	Rule::unique('materias','materia')->where('id_carrera',$request->id_carrera)->whereNot('id_materia',$request->id_materia),
            	],

            'nivel' => 'required',

            'codigo' => [
            	'required',
            	Rule::unique('materias','codigo')->where('id_carrera',$request->id_carrera)->whereNot('id_materia',$request->id_materia),
            	],

            'sigla' => [
            	'required',
            	Rule::unique('materias','sigla')->where('id_carrera',$request->id_carrera)->whereNot('id_materia',$request->id_materia),
            	],
        ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        else {

            $materia= Materia::find($request->id_materia);
            
            $materia->materia= $request->materia;
            $materia->nivel= $request->nivel;
            $materia->codigo= $request->codigo;
            $materia->sigla= $request->sigla;
            $materia->detalle= $request->detalle;
            $materia->log= auth()->id();

            $materia->save();

            return response()->json($materia);
      }
    }

    /**
     * funcion para cambiar el estado de la materia
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function materiaEstado(Request $request) {

        $validator = Validator::make($request->all(), [
            'estado' => 'required',
        ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));

        else {

            $materia= Materia::find($request->id_materia);
            $materia->log= auth()->id();
            $materia->estado= $request->estado;
            
            $materia->save();


            return response()->json($materia);
      }
    }

    /**
     * funcion para mandar una lista de dependencias de materias
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function materia_listaDependientes(Request $request){

        $lista= DB::table('materias')
        ->leftJoin('dependencias', function($join) use($request){
        	$join->on('materias.id_materia','=','dependencias.id_previa')
        	->where('dependencias.id_materia','=',$request->id_materia);
        })
        ->select('materias.*',DB::raw('count(dependencias.id_dependencia) AS cantidad')) 
        ->where('materias.id_carrera', '=', $request->id_carrera)
        ->where('materias.id_materia', '!=', $request->id_materia)
        ->where('materias.estado','=','activo')
        ->groupBy('materias.id_materia')
        ->orderBy('materias.nivel', 'ASC')
        ->orderBy('materias.codigo', 'ASC')->get();

        return response()->json($lista);
    }

    /**
     * funcion para generar una dependencia
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function materia_dependencia(Request $request){

        Dependencia::where('id_materia',$request->id_padre)->where('id_previa',$request->id_materia)->delete();

        if($request->cantidad == 0){
	        $dependencia= new Dependencia();

	        $dependencia->id_previa= $request->id_materia;
	        $dependencia->id_materia= $request->id_padre;
	        $dependencia->log= auth()->id();
	        
	        $dependencia->save();

	        return response()->json($dependencia);
        }

        return response()->json($request);
    }
}
