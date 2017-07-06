<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Cpublicacion extends Model
{
    protected $table = 'cpublicaciones';
    protected $primaryKey = 'id_cpublicacion';

    public $fillable = [
    	'titulo' ,'detalle', 'contenido', 'etiqueta', 'publicador', 'fecha_inicio', 'fecha_fin', 'id_importancia', 'id_carrera', 'id_ftp', 'estado', 'log', 
    	];

    
    public function carrera(){
        return $this->belongsTo('App\Modelos\Carrera', 'id_carrera', 'id_carrera');
    }

    public function ftipo_publicacion(){
        return $this->belongsTo('App\Modelos\FtipoPublicacion', 'id_ftp', 'id_ftp');
    }

    public function importancia(){
        return $this->belongsTo('App\Modelos\Importancia', 'id_importancia', 'id_importancia');
    }
}
