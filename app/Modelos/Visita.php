<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    protected $table = 'visitas';
    protected $primaryKey = 'id_visita';

    public $fillable = [
    	'visita', 'id_fpublicacion', 'ciudad', 'ip', 'fecha', 
    	];

    public function fpublicacion(){
        return $this->belongsTo('App\Modelos\Fpublicacion', 'id_fpublicacion', 'id_fpublicacion');
    }
}
