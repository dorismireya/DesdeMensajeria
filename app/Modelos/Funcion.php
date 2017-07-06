<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Funcion extends Model
{
    protected $table = 'funciones';
    protected $primaryKey = 'id_funcion';

    public $fillable = [
    	'funcion', 'icono', 'detalle', 
    	'estado'
    	];

    public function tarea(){
    	return $this->hasMany('App\Modelos\Tarea', 'id_funcion', 'id_funcion');
    }
}
