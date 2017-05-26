<?php

namespace Idrd\Usuarios\Repo;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Config as Config;

class Genero extends Eloquent {
	
	protected $table = 'genero';
	protected $primaryKey = 'Id_Genero';
	protected $fillable = ['Nombre_Genero'];
	protected $connection = '';
	public $timestamps = false;

	public function __construct()
	{
        parent::__construct();
		$this->connection = config('usuarios.conexion');
	}

	public function personas()
	{
		return $this->hasMany(config('usuarios.modelo_genero'), 'Id_Genero');
	}
}