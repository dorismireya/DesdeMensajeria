<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class DocenteMateria extends Model
{
    protected $table = 'docentes_materias';
    protected $primaryKey = 'id_docente_materia';

    public $fillable = [
    	'id_docente' ,'id_materia', 'log'
    	];

    public function docente(){
    	return $this->belongsTo('App\Modelos\Docente', 'id_docente', 'id_docente');
    }

    public function materia(){
    	return $this->belongsTo('App\Modelos\Materia', 'id_materia', 'id_materia');
    }
}
