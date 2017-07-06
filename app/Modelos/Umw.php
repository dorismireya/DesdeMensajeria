<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Umw extends Model
{
    protected $table = 'umws';
    protected $primaryKey = 'id_umw';

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
