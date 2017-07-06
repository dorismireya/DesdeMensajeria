<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    protected $table = 'etiquetas';
    protected $primaryKey = 'id_etiqueta';

    public $fillable = [
    	'etiqueta', 'log', 
    	];

    public function fpublicacionEtiqueta(){
    	return $this->hasMany('App\Modelos\fpublicacionEtiqueta', 'id_etiqueta', 'id_etiqueta');
    }

}
