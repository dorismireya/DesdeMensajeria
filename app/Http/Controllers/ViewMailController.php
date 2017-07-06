<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modelos\Mensaje;

class ViewMailController extends Controller
{
      public function getMail($id_mensaje){

    	$mensaje = Mensaje::findOrFail($id_mensaje);

    	return view('adminlte::sistema.view_mail', compact('mensaje'));
    }
}
