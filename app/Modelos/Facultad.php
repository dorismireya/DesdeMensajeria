<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    protected $table = 'facultades';
    protected $primaryKey = 'id_facultad';

    public $fillable = [
    	'facultad', 'universidad', 'telefono', 'fax', 'logo', 'web', 'direccion', 'autoridad', 'mision', 'vision', 'historia', 'detalle', 'log',
    	'estado'
    	];

    public function carrera(){
    	return $this->hasMany('App\Modelos\Carrera', 'id_facultad', 'id_facultad');
    }

    public function ufw(){
    	return $this->hasMany('App\Modelos\Ufw', 'id_facultad', 'id_facultad');
    }

    public function ufp(){
        return $this->hasMany('App\Modelos\Ufp', 'id_facultad', 'id_facultad');
    }

}
