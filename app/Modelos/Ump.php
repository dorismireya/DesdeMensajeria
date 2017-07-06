<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Ump extends Model
{
    protected $table = 'umps';
    protected $primaryKey = 'id_ump';

    public $fillable = [
    	'id' ,'id_materia', 'log'
    	];

    public function usuario(){
    	return $this->belongsTo('App\Modelos\Usuario', 'id', 'id');
    }

    public function materia(){
    	return $this->belongsTo('App\Modelos\Materia', 'id_materia', 'id_materia');
    }
}
