<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table = 'materias';
    protected $primaryKey = 'id_materia';

    public $fillable = [
    	'materia', 'nivel', 'codigo', 'sigla', 'horario', 'detalle', 'log',
    	'estado'
    	];

    public function carrera(){
    	return $this->belongsTo('App\Modelos\Carrera', 'id_carrera', 'id_carrera');
    }

    public function dependencia(){
    	return $this->hasMany('App\Modelos\Dependencia', 'id_materia', 'id_materia');
    }

    public function docenteMateria(){
    	return $this->hasMany('App\Modelos\DocenteMateria', 'id_materia', 'id_materia');
    }

    public function umw(){
        return $this->hasMany('App\Modelos\Umw', 'id_materia', 'id_materia');
    }

    public function ump(){
        return $this->hasMany('App\Modelos\Ump', 'id_materia', 'id_materia');
    }

    public function ftipo_publicacion(){
        return $this->hasMany('App\Modelos\FtipoPublicacion', 'id_materia', 'id_materia');
    }

    public function mpublicacion(){
        return $this->hasMany('App\Modelos\Mpublicacion', 'id_materia', 'id_materia');
    }

}
