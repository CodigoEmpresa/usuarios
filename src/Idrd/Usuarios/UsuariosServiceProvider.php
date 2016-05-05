<?php

namespace Idrd\Usuarios;

use Illuminate\Support\ServiceProvider;
use Idrd\Usuarios\Repo\EloquentPersona;

class UsuariosServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'usuarios');

		$this->loadViewsFrom(__DIR__ . '/../../resources/views', 'usuarios');
		
		$this->publishes([
	        __DIR__.'/../../config/usuarios.php' => config_path('usuarios.php'),
	    ]);

	    $this->publishes([
	        __DIR__.'/../../resources/views' => resource_path('views/idrd/usuarios'),
	    ]);

	     $this->publishes([
	        __DIR__.'/../../resources/assets' => public_path('Js/usuarios'),
	    ], 'public');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('Idrd\Usuarios\Repo\PersonaInterface',function($app){
			return new EloquentPersona($app);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}

}
