<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class TareaRol extends Model
{
   	protected $table = 'tareas_roles';
    protected $primaryKey = 'id_tarea_rol';

    public $fillable = [
    	'id_tarea' ,'id_rol'
    	];

    public function tarea(){
    	return $this->belongsTo('App\Modelos\Tarea', 'id_tarea', 'id_rol');
    }

    public function rol(){
    	return $this->belongsTo('App\Modelos\Rol', 'id_rol', 'id_tarea');
    }

}
