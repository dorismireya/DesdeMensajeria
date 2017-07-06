<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id_rol';

    public $fillable = [
    	'rol', 'detalle', 'estado'
    	];

    public function tareaRol(){
    	return $this->hasMany('App\Modelos\TareaRol', 'id_rol', 'id_rol');
    }
}
