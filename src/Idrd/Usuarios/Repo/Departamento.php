<?php

namespace Idrd\Usuarios\Repo;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Config as Config;


class DepartamentoModel extends Eloquent {
	
   	protected $table = 'departamento';
    protected $primaryKey = 'Id_Departamento';
    protected $fillable = ['Nombre_Departamento'];
    protected $connection = '';
​
    public $timestamps = false;
    
    public function __construct()
    {
        $this->connection = config('usuarios.conexion');
    }
}