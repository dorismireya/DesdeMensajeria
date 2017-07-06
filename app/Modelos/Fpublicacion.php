<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Fpublicacion extends Model
{
    protected $table = 'fpublicaciones';
    protected $primaryKey = 'id_fpublicacion';

    public $fillable = [
    	'titulo' ,'detalle', 'contenido', 'etiqueta', 'publicador', 'fecha_inicio', 'fecha_fin', 'tabla', 'id_tabla', 'area', 'id_importancia', 'id_ftp', 'estado', 'log', 
    	];

    public function ftipo_publicacion(){
        return $this->belongsTo('App\Modelos\FtipoPublicacion', 'id_ftp', 'id_ftp');
    }

    public function importancia(){
        return $this->belongsTo('App\Modelos\Importancia', 'id_importancia', 'id_importancia');
    }
    public function fpublicacionEtiqueta(){
        return $this->hasMany('App\Modelos\fpublicacionEtiqueta', 'id_fpublicacion', 'id_fpublicacion');
    }
    public function visita(){
        return $this->hasMany('App\Modelos\Visita', 'id_visita', 'id_visita');
    }
}
