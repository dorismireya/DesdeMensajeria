<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Usuario extends User
{

    protected $table = 'users';
    protected $primaryKey = 'id';

    public $fillable = [
    	'name', 'email', 'password', 'tipo', 'educacion', 'biografia', 'foto', 'estado', 'log'
    	];

	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
    	if($value !== null)
    		$this->attributes['password'] = bcrypt($value);
    }
    
    public function getNombreCompletoAttribute()
    {
        return $this->attributes['name'];
    }

    public function usuarioTarea(){
        return $this->hasMany('App\Modelos\UsuarioTarea', 'id_usuario', 'id');
    }

    public function docente(){
        return $this->hasOne('App\Modelos\Docente', 'id', 'id');
    }

    public function ufw(){
        return $this->hasMany('App\Modelos\Ufw', 'id', 'id');
    }

    public function ucw(){
        return $this->hasMany('App\Modelos\Ucw', 'id', 'id');
    }

    public function umw(){
        return $this->hasMany('App\Modelos\Umw', 'id', 'id');
    }

    public function ufp(){
        return $this->hasMany('App\Modelos\Ufp', 'id', 'id');
    }

    public function ucp(){
        return $this->hasMany('App\Modelos\Ucp', 'id', 'id');
    }

    public function ump(){
        return $this->hasMany('App\Modelos\Ump', 'id', 'id');
    }

    public function usuarioImportancia(){
        return $this->hasMany('App\Modelos\UsuarioImportancia', 'id', 'id');
    }

    public function usuarioFtp(){
        return $this->hasMany('App\Modelos\UsuarioFtp', 'id', 'id');
    }

}
    