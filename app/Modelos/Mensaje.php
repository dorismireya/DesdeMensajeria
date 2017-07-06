<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $table = 'mensajes';
    protected $primaryKey = 'id_mensaje';

    public $fillable = [
    	'asunto','id_origen', 'asunto', 'mensaje', 'fecha', 'estado', 'log'
    	];

    public function mensaje_destino(){
        return $this->hasMany('App\Modelos\MensajeDestino', 'id_mensaje', 'id_mensaje');
    }

}
