<?php

namespace Idrd\Usuarios\Repo;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Config as Config;

class Etnia extends Eloquent {
	
	protected $table = 'etnia';
	protected $primaryKey = 'Id_Etnia';
	protected $fillable = ['Nombre_Etnia'];
	protected $connection = '';
	public $timestamps = false;

	public function __construct()
	{
        parent::__construct();
		$this->connection = config('usuarios.conexion');
	}

	public function personas()
	{
		return $this->hasMany(config('usuarios.modelo_etnia'), 'Id_Etnia');
	}
}