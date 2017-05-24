<?php

namespace Idrd\Usuarios\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocalizacionController extends Controller {

	public function buscarCiudades(Request $request, $id_pais)
	{
		$pais_model = app()->make(config('usuarios.modelo_pais'));
		$pais = $pais_model->find($id_pais);

		return response()->json($pais->ciudades);
	}

}