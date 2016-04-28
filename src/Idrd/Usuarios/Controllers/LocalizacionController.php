<?php

namespace Idrd\Usuarios\Controllers;

use App\Pais;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocalizacionController extends Controller {

	public function buscarCiudades(Request $request, $id_pais)
	{
		$pais = Pais::find($id_pais);

		return response()->json($pais->ciudades);
	}

}