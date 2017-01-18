<?php

namespace Idrd\Usuarios\Controllers;

use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Validator;

class PersonaController extends Controller {

	private $repositorio_personas;

	public function __construct(PersonaInterface $repositorio_personas)
	{
		$this->repositorio_personas = $repositorio_personas;
	}

	public function index(Request $request)
	{	
		$perPage = 10;
		$page = $request->input('page' , 1);
		$pagiData = $this->repositorio_personas->obtenerPaginados($page, $perPage);
		$documento = app()->make(config('usuarios.modelo_documento'));
		$paises = app()->make(config('usuarios.modelo_pais'));
		$etnias = app()->make(config('usuarios.modelo_etnia'));

		$lista = [
			'personas' => new LengthAwarePaginator(
	            $pagiData->items,
	            $pagiData->totalItems,
	            $perPage,
	            Paginator::resolveCurrentPage(),
	        	['path' => Paginator::resolveCurrentPath()]
	        ),
	        'documentos' => $documento->all(),
	        'paises' => $paises->all(),
	        'etnias' => $etnias->all(),
			'status' => session('status')
		];

		$datos = [
			'seccion' => config('usuarios.seccion'),
			'lista'	=> view(config('usuarios.lista'), $lista)
		];
		return view(config('usuarios.vista_lista'),$datos);
	}

	public function buscar(Request $request, $key)
	{
		$resultados = $this->repositorio_personas->buscar($key);

		return response()->json($resultados);
	}

	public function obtener(Request $request, $id)
	{
		$persona = $this->repositorio_personas->obtener($id);

		return response()->json($persona);
	}

	public function procesar(Request $request)
	{
		$validator = Validator::make($request->all(),
			[
	            'Id_TipoDocumento' => 'required|min:1',
				'Cedula' => 'required|numeric',
				'Primer_Apellido' => 'required',
				'Primer_Nombre' => 'required',
				'Fecha_Nacimiento' => 'required|date',
				'Id_Etnia' => 'required|min:1',
				'Id_Pais' => 'required|min:1',
				'Id_Genero' => 'required|in:1,2'
        	]
        );

        if ($validator->fails())
            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
        
        if($request->input('Id_Persona') == '0')
        	$this->repositorio_personas->guardar($request->all());
        else
        	$this->repositorio_personas->actualizar($request->all());

        return response()->json(array('status' => 'ok'));
	}

	public function eliminar(Request $request, $id)
	{

	}

	public function buscarPersonaTipo(Request $request, $id_tipo){
		$personas = $this->repositorio_personas->buscarPersonaTipo($id_tipo);
		return response()->json($personas);
	}

}