#usuarios - personas IDRD

Instalacion:

1. En composer.json agregar:

```json
"require": {
    "idrd/usuarios": "dev-master"
}
```

2. Realizar composer update;

En config/app agregar:

```php
'providers' => [
	...
    Idrd\Usuarios\UsuariosServiceProvider::class,
]
```

3. Ejecutar 'php artisan vendor:publish' para que se copien los archivos de configuración y vistas al proyecto.

config/usuarios.php
resources/views/idrd/usuarios/lista.blade.php

4. Crear modelos para Ciudad, Documento, Etnia, Genero, Pais y Persona y extender los modelos del modulo de usuarios.

Para crear el modelo ejecutar php artisan make:model Documento y extender el modelo respectivo del paquete.

```php
namespace App;

use Idrd\Usuarios\Repo\Documento as MDocumento;

class Documento extends MDocumento
{
    //
}
```

5. Pegar en el archivo de rutas las siguientes rutas (app/Http/routes.php):

```php
Route::get('/personas', '\Idrd\Usuarios\Controllers\PersonaController@index');
Route::get('/personas/service/obtener/{id}', '\Idrd\Usuarios\Controllers\PersonaController@obtener');
Route::get('/personas/service/buscar/{key}', '\Idrd\Usuarios\Controllers\PersonaController@buscar');
Route::get('/personas/service/ciudad/{id_pais}', '\Idrd\Usuarios\Controllers\LocalizacionController@buscarCiudades');
Route::post('/personas/service/procesar/', '\Idrd\Usuarios\Controllers\PersonaController@procesar');
```

Nota: si desea cambiar el prefijo de la ruta a uno diferente de personas/ debe modificar la clave "prefijo_ruta" en el archivo de configuración (config/usuarios.php)

6. Crear una conexión nueva que apunte a la base de datos de personas en el archivo de configuración (config/database.php): 

```php
'connections' => [
    'mysql' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', 'db_modulo'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'database'),
        'username' => env('DB_USERNAME', 'user'),
        'password' => env('DB_PASSWORD', 'pass'),
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
    ],

    'db_principal' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', 'db_principal'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'database'),
        'username' => env('DB_USERNAME', 'user'),
        'password' => env('DB_PASSWORD', 'pass'),
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
    ]
],
```

7. Editar el archivo de configuración de usuarios (config/usuarios.php)

```php
return array( 
 
  'conexion' => 'db_principal', 
   
  'prefijo_ruta' => 'personas', 
 
  'modelo_persona' => 'App\Persona', 
  'modelo_documento' => 'App\Documento', 
  'modelo_pais' => 'App\Pais',
  'modelo_ciudad' => 'App\Ciudad',
  'modelo_departamento' => 'App\Departamento',
  'modelo_genero' => 'App\Genero', 
  'modelo_etnia' => 'App\Etnia', 
   
  //vistas que carga las vistas 
  'vista_lista' => 'list', 
 
  //lista 
  'lista'  => 'idrd.usuarios.lista', 
);
```
