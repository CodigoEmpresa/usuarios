<?php

namespace Idrd\Usuarios\Repo;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Config as Config;

class Modulo extends Model
{
    protected $table = 'modulo';
    protected $primaryKey = 'Id_Modulo';
    protected $fillable = ['Nombre_Modulo', 'Redireccion', 'Imagen'];
    protected $connection = '';

    public $timestamps = false;
    
    public function __construct()
    {
        parent::__construct();
        $this->connection = 'db_principal';
    }
}