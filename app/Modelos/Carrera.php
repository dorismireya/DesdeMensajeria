<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    protected $table = 'carreras';
    protected $primaryKey = 'id_carrera';

    public $fillable = [
    	'carrera', 'codigo', 'mision', 'vision', 'proyeccion', 'autoridad', 'logo', 'detalle', 'log',
    	'estado'
    	];

    public function materia(){
    	return $this->hasMany('App\Modelos\Materia', 'id_carrera', 'id_carrera');
    }

    public function facultad(){
    	return $this->belongsTo('App\Modelos\Facultad', 'id_facultad', 'id_facultad');
    }

    public function ucw(){
        return $this->hasMany('App\Modelos\Ucw', 'id_carrera', 'id_carrera');
    }

    public function ucp(){
        return $this->hasMany('App\Modelos\Ucp', 'id_carrera', 'id_carrera');
    }

    public function ftipo_publicacion(){
        return $this->hasMany('App\Modelos\FtipoPublicacion', 'id_carrera', 'id_carrera');
    }

    public function cpublicacion(){
        return $this->hasMany('App\Modelos\Cpublicacion', 'id_carrera', 'id_carrera');
    }
}
