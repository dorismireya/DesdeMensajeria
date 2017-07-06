<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tareas';
    protected $primaryKey = 'id_tarea';

    public $fillable = [
    	'id_funcion' ,'tarea', 'vista', 'icono', 
    	'detalle', 'estado'
    	];

    public function usuarioTarea(){
    	return $this->hasMany('App\Modelos\UsuarioTarea', 'id_tarea', 'id_tarea');
    }

    public function funcion(){
    	return $this->belongsTo('App\Modelos\Funcion', 'id_funcion', 'id_funcion');
    }

    public function tareaRol(){
    	return $this->hasMany('App\Modelos\TareaRol', 'id_rol', 'id_rol');
    }
}
