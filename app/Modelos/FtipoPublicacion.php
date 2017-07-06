<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class FtipoPublicacion extends Model
{
    protected $table = 'ftipo_publicaciones';
    protected $primaryKey = 'id_ftp';

    public $fillable = [
    	'tipo' ,'detalle', 'estado', 'posicion', 'log',
    	];

    
    
    public function fpublicacion(){
    	return $this->hasMany('App\Modelos\Fpublicacion', 'id_ftp', 'id_ftp');
    }

    public function usuarioFtp(){
        return $this->hasMany('App\Modelos\UsuarioFtp', 'id_ftp', 'id_ftp');
    }
}
