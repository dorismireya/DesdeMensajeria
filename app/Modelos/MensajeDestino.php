<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class MensajeDestino extends Model
{
    protected $table = 'mensajes_destinos';
    protected $primaryKey = 'id_md';

    public $fillable = [
    	'id_mensaje', 'id_destino', 
    	];

    public function mensaje(){
        return $this->belongsTo('App\Modelos\Mensaje', 'id_mensaje', 'id_mensaje');
}
