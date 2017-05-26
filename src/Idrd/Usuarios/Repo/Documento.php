<?php

namespace Idrd\Usuarios\Repo;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Config as Config;

class Documento extends Eloquent {
	
	protected $table = 'tipo_documento';
	protected $primaryKey = 'Id_TipoDocumento';
	protected $fillable = ['Nombre_TipoDocumento', 'Descripcion_TipoDocumento'];
	protected $connection = '';
	public $timestamps = false;

	public function __construct()
	{
        parent::__construct();
		$this->connection = config('usuarios.conexion');
	}

	public function personas()
	{
		return $this->hasMany(config('usuarios.modelo_documento'), 'Id_TipoDocumento');
	}
}