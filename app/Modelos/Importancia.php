<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Importancia extends Model
{
    protected $table = 'importancias';
    protected $primaryKey = 'id_importancia';

    public $fillable = [
    	'importancia' ,'posicion', 'estado', 'log',
    	];

    
    public function fpublicacion(){
    	return $this->hasMany('App\Modelos\Fpublicacion', 'id_importancia', 'id_importancia');
    }

    public function usuarioImportancia(){
        return $this->hasMany('App\Modelos\UsuarioImportancia', 'id_importancia', 'id_importancia');
    }

    public function cpublicacion(){
        return $this->hasMany('App\Modelos\Cpublicacion', 'id_importancia', 'id_importancia');
    }

    public function mpublicacion(){
        return $this->hasMany('App\Modelos\mpublicacion', 'id_importancia', 'id_importancia');
    }
}
