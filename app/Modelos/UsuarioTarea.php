<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class UsuarioTarea extends Model
{
    protected $table = 'usuarios_tareas';
    protected $primaryKey = 'id_usuario_tarea';

    public $fillable = [
    	'id_usuario' ,'id_tarea'
    	];

    public function usuario(){
    	return $this->belongsTo('App\Modelos\Usuario', 'id', 'id_tarea');
    }

    public function tarea(){
    	return $this->belongsTo('App\Modelos\Tarea', 'id_tarea', 'id_usuario');
    }

    
}
