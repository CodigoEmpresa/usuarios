<?php

namespace Idrd\Usuarios\Seguridad;

trait TraitSeguridad {

  public static function boot()
 {
    parent::boot();

    static::creating(function($model)
    {
     \DB::connection('db_principal')->table('seguridad')->insert([ 
        'Id_Modulo' => config('usuarios.modulo'),
        'Fecha' => date('Y-m-d H:i:s'),
        'Id_Persona' =>  $_SESSION['Usuario'][0],
        'Tabla' => $model->getTableName(),
        'Operacion' =>'create' ,
        'antes'=>'', 
        'ahora' => $model->toJson(),
        'Ip' => $_SERVER['REMOTE_ADDR']
      ]);  
    });

    static::updating(function($model)
    {
    
     \DB::connection('db_principal')->table('seguridad')->insert([ 
        'Id_Modulo' => config('usuarios.modulo'),
        'Fecha' => date('Y-m-d H:i:s'),
        'Id_Persona' => $_SESSION['Usuario'][0],
        'Tabla' => $model->getTableName(),
        'Operacion' => 'update' ,
        'antes'=>'', 
        'ahora' => $model->toJson(),
        'Ip' => $_SERVER['REMOTE_ADDR']
      ]);
    });

     static::deleting(function($model)
    {
    
     \DB::connection('db_principal')->table('seguridad')->insert([ 
        'Id_Modulo' => config('usuarios.modulo'),
        'Fecha' => date('Y-m-d H:i:s'),
        'Id_Persona' => $_SESSION['Usuario'][0],
        'Tabla' => $model->getTableName(),
        'Operacion' => 'delete' ,
        'antes'=>'', 
        'ahora' => $model->toJson(),
        'Ip' => $_SERVER['REMOTE_ADDR']
      ]);
    });
  }

  private function getTableName()
  {
    return $this->table;
  }

}


?>