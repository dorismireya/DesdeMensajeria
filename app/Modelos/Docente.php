<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table = 'docentes';
    protected $primaryKey = 'id_docente';

    public $fillable = [
    	'tipo', 'telefono', 'eduacacion','biografia', 'foto', 'detalle',  'log',
    	'estado'
    	];

    public function docenteMateria(){
    	return $this->hasMany('App\Modelos\DocenteMateria', 'id_docente', 'id_docente');
    }

    public function usuario(){
    	return $this->belongsTo('App\Modelos\Usuario', 'id', 'id');
    }
}
