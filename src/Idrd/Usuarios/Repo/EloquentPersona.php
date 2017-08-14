<?php 

namespace Idrd\Usuarios\Repo;

use Idrd\Usuarios\Repo\PersonaInterface;


class EloquentPersona implements PersonaInterface {

	private $app;
	private $model;

	public function __construct($app)
	{
		$this->app = $app ?: app();
	}

	public function guardar($input)
	{
		$model = $this->model(self::MODELO_PERSONA);
		$persona =  $model->newInstance(array());

		return $this->store($persona, $input);
	}

	public function actualizar($input)
	{
		$model = $this->model(self::MODELO_PERSONA);
		$persona = $model->find($input['Id_Persona']);

		return $this->store($persona, $input);
	}

	public function eliminar($id)
	{
		$model = $this->model(self::MODELO_PERSONA);
		$persona = $model->find($id);

		if($persona->delete())
			return true;
		else 
			return false;
	}

	public function obtener($id)
	{
		$model = $this->model(self::MODELO_PERSONA);
		$persona = $model->find($id);
		return $persona;
	}
 
	public function obtenerPaginados($pagina, $limite)
	{
		$model = $this->model(self::MODELO_PERSONA);

		$personas = $model->orderBy('Primer_Apellido', 'asc')
					->orderBy('Primer_Nombre', 'asc')
					->skip($limite * ($pagina-1))
					->take($limite)
					->get();

		$data = new \StdClass();

		if (!$personas)
		{
			$data->items = array();
			$data->totalItems = 0;
			return $data;
		}

		$data->items = $personas->all();
		$data->totalItems = $this->totalPersonas();

		return $data;
	}

	public function buscar($key)
	{
		$model = $this->model(self::MODELO_PERSONA);

		return $model->with('tipoDocumento')
					->whereRaw('CONCAT (Cedula, " ", Primer_Apellido, " ", Segundo_Apellido, " ", Primer_Nombre, " ", Segundo_Nombre) LIKE "%'.$key.'%"', array())
					->orderBy('Primer_Apellido', 'asc')
					->orderBy('Primer_Nombre', 'asc')
					->take(1000)
					->get();
	}

	public function buscarPersonaTipo($id_tipo)
	{
		$model = $this->model(self::MODELO_TIPO);	
		$tipo = $model->with('personas')
					->where('Id_Tipo', $id_tipo)
					->first();

		return $tipo->personas;
	}

	private function store($model, $input)
	{
		$model['Cedula'] = $input['Cedula'];
		$model['Primer_Apellido'] = $input['Primer_Apellido'];
		$model['Segundo_Apellido'] = $input['Segundo_Apellido'];
		$model['Primer_Nombre'] = $input['Primer_Nombre'];
		$model['Segundo_Nombre'] = $input['Segundo_Nombre'];
		$model['Fecha_Nacimiento'] = $input['Fecha_Nacimiento'];
		$model['Nombre_Ciudad'] = $input['Nombre_Ciudad'];
		$model['Id_Pais'] = $input['Id_Pais'];
		$model['Id_TipoDocumento'] = $input['Id_TipoDocumento'];
		$model['Id_Pais'] = $input['Id_Pais'];
		$model['Id_Genero'] = $input['Id_Genero'];
		$model['Id_Etnia'] = $input['Id_Etnia'];



		$model->save();
		return $model;
	}

	private function totalPersonas()
	{
		$model = $this->model(self::MODELO_PERSONA);
		$personas = $model->count();
		return $personas;
	}

	private function model($model)
	{
		$this->model = $this->app['config']->get('usuarios.'.$model);
		if ($this->model)
			return $this->app[$this->model];
		
		throw new \Exception("No se encuentra el modelo especificado en idrd/personas/config/config.php", 639);
	}


}