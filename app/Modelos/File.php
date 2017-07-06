<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    protected $primaryKey = 'id_file';

    public $fillable = [
    	'titulo' ,'detalle', 'direccion', 'tabla', 'id_tabla', 'estado', 'log'
    	];
}
