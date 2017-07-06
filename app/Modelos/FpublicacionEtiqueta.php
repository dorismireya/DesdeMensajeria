<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class FpublicacionEtiqueta extends Model
{
    protected $table = 'fpublicaciones_etiquetas';
    protected $primaryKey = 'id_fpe';

    public $fillable = [
    	'id_fpublicacion' ,'id_etiqueta', 'log'
    	];

    public function usuario(){
    	return $this->belongsTo('App\Modelos\Fpublicacion', 'id_fpublicacion', 'id_fpublicacion');
    }

    public function etiqueta(){
    	return $this->belongsTo('App\Modelos\Etiqueta', 'id_etiqueta', 'id_etiqueta');
    }
}
