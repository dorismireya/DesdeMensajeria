<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class UsuarioFtp extends Model
{
    protected $table = 'usuarios_ftps';
    protected $primaryKey = 'id_uftp';

    public $fillable = [
    	'id' ,'id_ftp', 'log'
    	];

    public function usuario(){
    	return $this->belongsTo('App\Modelos\Usuario', 'id', 'id');
    }

    public function ftipopublicacion(){
    	return $this->belongsTo('App\Modelos\FtipoPublicacion', 'id_ftp', 'id_ftp');
    }
}
