<?php

namespace Idrd\Usuarios\Repo;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Config as Config;


class acceso extends Eloquent {
	
   	protected $table = 'acceso';
       
    public function __construct()
    {
        $this->connection = config('usuarios.conexion');
    }
}