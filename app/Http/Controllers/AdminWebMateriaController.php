<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use Response;
use App\Modelos\Materia;

class AdminWebMateriaController extends Controller
{
    public function index($id_materia){

        if(Auth()->user() == null)
            return redirect()->route('index');

        $materia_valida= DB::table('users')
        ->join('umws','users.id','=','umws.id')
        ->select(DB::raw('count(umws.id_umw) AS cantidad'))
        ->where('users.id', '=', Auth()->user()->id)
        ->where('umws.id_materia', '=', $id_materia)->get();

        if($materia_valida[0]->cantidad == 0)
            return view('adminlte::errors.404');
        
        
        $materia = Materia::findOrFail($id_materia);


        return view('adminlte::sistema.admin_web_materia', compact('materia'));
    }

    /**
     * funcion para editar los datos de materia
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function adminWebMateria_edit(Request $request){

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
        else{

            $materia= Materia::find($request->id_materia);
            $materia->nivel = $request->nivel;
            $materia->codigo = $request->codigo;
            $materia->materia = $request->materia;
            $materia->sigla = $request->sigla;

            $materia->log= auth()->id();

            $materia->save();

            return response()->json($materia);
        }

    }

    /**
     * funcion para editar campos
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function adminWebMateria_campos(Request $request){

        $validator = Validator::make($request->all(), [
                'id_materia' => 'required',
            ]);

        if ($validator->fails())
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        else{

            $materia= Materia::find($request->id_materia);
            if($request->variable == "horario")
                $materia->horario = $request->contenido;

            if($request->variable == "descripcion")
                $materia->detalle = $request->contenido;
            
            $materia->log= auth()->id();
            $materia->save();
            
            return response()->json($materia);
        }

    }
}
