<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Mpublicacion extends Model
{
   	protected $table = 'mpublicaciones';
    protected $primaryKey = 'id_mpublicacion';

    public $fillable = [
    	'titulo' ,'detalle', 'contenido', 'etiqueta', 'publicador', 'fecha_inicio', 'fecha_fin', 'id_importancia', 'id_materia', 'id_ftp', 'estado', 'log', 
    	];

    
    public function materia(){
        return $this->belongsTo('App\Modelos\Materia', 'id_materia', 'id_materia');
    }

    public function ftipo_publicacion(){
        return $this->belongsTo('App\Modelos\FtipoPublicacion', 'id_ftp', 'id_ftp');
    }

    public function importancia(){
        return $this->belongsTo('App\Modelos\Importancia', 'id_importancia', 'id_importancia');
    }
}
