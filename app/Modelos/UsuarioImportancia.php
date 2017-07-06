<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class UsuarioImportancia extends Model
{
    protected $table = 'usuarios_importancias';
    protected $primaryKey = 'id_ui';

    public $fillable = [
    	'id' ,'id_importancia', 'log'
    	];

    public function usuario(){
    	return $this->belongsTo('App\Modelos\Usuario', 'id', 'id');
    }

    public function importancia(){
    	return $this->belongsTo('App\Modelos\Importancia', 'id_importancia', 'id_importancia');
    }
}
