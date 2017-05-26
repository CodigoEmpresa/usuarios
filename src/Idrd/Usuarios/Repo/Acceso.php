<?php

namespace Idrd\Usuarios\Repo;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Config as Config;


class Acceso extends Eloquent {
	
   	protected $table = 'acceso';
       
    public function __construct()
    {
        parent::__construct();
        $this->connection = config('usuarios.conexion');
    }

    public function persona()
	{
		return $this->belongsTo(config('usuarios.modelo_persona'), 'Id_Persona');
	}
}