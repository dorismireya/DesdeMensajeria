<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Ucw extends Model
{
    protected $table = 'ucws';
    protected $primaryKey = 'id_ucw';

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
