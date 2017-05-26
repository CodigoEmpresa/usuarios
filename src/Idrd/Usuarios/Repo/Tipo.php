<?php

namespace Idrd\Usuarios\Repo;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Config as Config;

class Tipo extends Eloquent {
	
	protected $table = 'tipo';
	protected $primaryKey = 'Id_Tipo';
	protected $fillable = ['Nombre','Id_Modulo'];
	protected $connection = '';
	public $timestamps = false;

	public function __construct()
	{
        parent::__construct();
		$this->connection = config('usuarios.conexion');
	}

	public function personas()
	{
		return $this->belongsToMany(config('usuarios.modelo_persona'), 'persona_tipo', 'Id_Tipo', 'Id_Persona');
	}
}