<?php

namespace Idrd\Usuarios\Repo;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Config as Config;

class Ciudad extends Eloquent {
	
	protected $table = 'ciudad';
	protected $primaryKey = 'Id_Ciudad';
	protected $fillable = ['Nombre_Ciudad', 'Id_Pais'];
	protected $connection = ''; 
	public $timestamps = false;

	public function __construct()
	{
        parent::__construct();
		$this->connection = config('usuarios.conexion');
	}

	public function pais()
	{
		return $this->belongsTo(config('usuarios.modelo_pais'), 'Id_Pais');
	}
}