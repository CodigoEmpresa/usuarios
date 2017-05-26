<?php

namespace Idrd\Usuarios\Repo;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Config as Config;

class Persona extends Eloquent {
	
	protected $table = 'persona';
	protected $primaryKey = 'Id_Persona';
	protected $fillable = ['Cedula', 'Primer_Apellido', 'Segundo_Apellido', 'Primer_Nombre', 'Segundo_Nombre', 'Fecha_Nacimiento', 'Nombre_Ciudad', 'Id_Pais', 'Id_TipoDocumento', 'Id_Pais', 'Id_Genero', 'Id_Etnia'];
	protected $connection = '';
	public $timestamps = false;

	public function __construct()
	{
        parent::__construct();
		$this->connection = config('usuarios.conexion');
		$this->table = config('database.connections.'.$this->connection.'.database').'.'.$this->table;
	}

    public function acceso()
	{
		return $this->hasOne(config('usuarios.modelo_acceso'), 'Id_Persona');
	}
	
	
	 public function act()
	{
		return $this->belongsToMany(config('usuarios.modelo_asim'), 'actividad_acceso',  'Id_Persona','Id_Actividad')
					->withPivot('Estado');
	}
	
      public function datos()
	{
		return $this->hasOne(config('usuarios.modelo_datos'), 'Id_Persona');
	}

	public function tipoDocumento()
	{
		return $this->belongsTo(config('usuarios.modelo_documento'), 'Id_TipoDocumento');
	}

	public function pais()
	{
		return $this->belongsTo(config('usuarios.modelo_pais'), 'Id_Pais');
	}

	public function genero()
	{
		return $this->belongsTo(config('usuarios.modelo_genero'), 'Id_Genero');
	}

	public function etnia()
	{
		return $this->belongsTo(config('usuarios.modelo_etnia'), 'Id_Etnia');
	}

	public function tipo()
	{
		return $this->belongsToMany(config('usuarios.modelo_tipo'), 'persona_tipo', 'Id_Persona', 'Id_Tipo');
	}
}