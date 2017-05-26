<?php

namespace Idrd\Usuarios\Repo;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Config as Config;

class Localidad extends Eloquent {
	
	protected $table = 'localidad';
	protected $primaryKey = 'Id_Localidad';
	protected $fillable = ['Nombre_Localidad'];
	protected $connection = '';
	public $timestamps = false;

	public function __construct()
	{
        parent::__construct();
		$this->connection = config('usuarios.conexion');
	}


}