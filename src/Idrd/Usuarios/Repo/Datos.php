<?php

namespace Idrd\Usuarios\Repo;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Config as Config;


class Datos extends Eloquent {
	
   	protected $table = 'datos';
    protected $primaryKey = 'Id_Datos';
     protected $fillable = ['Id_Datos','Id_Persona','Telefono','Email','Celular','Rh','Direccion'];
       
    public function __construct()
    {
        parent::__construct();
        $this->connection = config('usuarios.conexion');
    }
    
    public function persona()
	{
		return $this->belongsTo(config('usuarios.modelo_persona'), 'Id_Persona');
	}
}