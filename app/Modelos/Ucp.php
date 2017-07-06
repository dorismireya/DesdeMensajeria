<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Ucp extends Model
{
    protected $table = 'ucps';
    protected $primaryKey = 'id_ucp';

    public $fillable = [
    	'id' ,'id_carrera', 'log'
    	];

    public function usuario(){
    	return $this->belongsTo('App\Modelos\Usuario', 'id', 'id');
    }

    public function carrera(){
    	return $this->belongsTo('App\Modelos\Carrera', 'id_carrera', 'id_carrera');
    }
}
