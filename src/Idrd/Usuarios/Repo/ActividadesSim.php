<?php

namespace Idrd\Usuarios\Repo;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Config as Config;


class ActividadesSim extends Eloquent
{
    protected $table = 'actividades';
    protected $primaryKey = 'Id_Actividad';
    protected $fillable = ['Id_Modulo', 'Nombre_Actividad', 'Descripcion'];
    protected $connection = '';

    public $timestamps = false;
    
    public function __construct()
    {
        parent::__construct();
        $this->connection = config('usuarios.conexion');
        $this->table = config('database.connections.'.$this->connection.'.database').'.'.$this->table;
    }

    public function persona()
	{
		return $this->belongsToMany(config('usuarios.modelo_persona'), 'actividad_acceso', 'Id_Actividad', 'Id_Persona');
	}

	public function modulo()
	{
		return $this->belongsTo(config('usuarios.modelo_modulo'), 'Id_Modulo');
	}
}
