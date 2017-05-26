<?php

namespace Idrd\Usuarios\Repo;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Config as Config;

class Pais extends Eloquent {
	
	protected $table = 'pais';
	protected $primaryKey = 'Id_Pais';
	protected $fillable = ['Nombre_Pais'];
	protected $connection = '';
	public $timestamps = false;

	public function __construct()
	{
        parent::__construct();
		$this->connection = config('usuarios.conexion');
	}

	public function personas()
	{
		return $this->hasMany(config('usuarios.modelo_persona'), 'Id_Pais');
	}

	public function ciudades()
	{
		return $this->hasMany(config('usuarios.modelo_ciudad'), 'Id_Pais');
	}
}