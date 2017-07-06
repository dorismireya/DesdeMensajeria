<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
    protected $table = 'dependencias';
    protected $primaryKey = 'id_dependencia';

    public $fillable = [
    	'id_previa', 'id_materia', 'log'
    	];

    public function materia(){
    	return $this->belongsTo('App\Modelos\Materia', 'id_materia', 'id_materia');
    }

    
}
