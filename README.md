#usuarios - personas IDRD

Instalacion:

En composer.json agregar:

```json
"require": {
    "idrd/usuarios": "dev-master"
}
```

Realizar composer update;

En config/app agregar:

```php
'providers' => [
	...
    Idrd\Usuarios\UsuariosServiceProvider::class,
]
```

Y ejecutar php artisan vendor:publish para que se copien los archivos de configuración y vistas al proyecto.

config/usuarios.php
resources/views/idrd/usuarios/lista.blade.php