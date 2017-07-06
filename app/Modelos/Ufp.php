<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Ufp extends Model
{
    protected $table = 'ufps';
    protected $primaryKey = 'id_ufp';

    public $fillable = [
    	'id' ,'id_facultad', 'log'
    	];

    public function usuario(){
    	return $this->belongsTo('App\Modelos\Usuario', 'id', 'id');
    }

    public function facultad(){
    	return $this->belongsTo('App\Modelos\Facultad', 'id_facultad', 'id_facultad');
    }
}
