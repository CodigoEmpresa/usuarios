<?php

namespace Idrd\Usuarios\Controllers;

use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Idrd\Usuarios\Repo\Persona;
use Idrd\Usuarios\Repo\ActividadesSim;
use Idrd\Usuarios\Repo\Tipo;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Validator;

class AsignarActividadController extends Controller {

	private $id_modulo;

	
    public function __construct()
    {  
        $this->id_modulo = config('usuarios.modulo');
    }

    public function tipoModulo()
    {
		$Tipo_Modulo = Tipo::join('modulo', 'tipo.Id_Modulo', '=', 'modulo.Id_Modulo')
					    	->where('tipo.Id_Modulo', '=', $this->id_modulo)
					    	->select('tipo.*')
					    	->get();
        return $Tipo_Modulo;
	}

	public function AdicionTipoPersona(Request $request)
	{
		$validator = Validator:: make($request->all(),[
            'Id' => 'required',
            'Id_Tipo' => 'required',
        ]);
        
        if ($validator->fails()) {
        
            return response()->json(["Bandera" => 0, "Mensaje" => ", pero ocurrio un error en la validación de la imagen o su tamaño."]);
        
        }else{     

        	$id_modulo = $this->id_modulo ;   

        	$persona = Persona::with(['tipo' => function($query) use ($id_modulo)
			{
				$query->where('Id_Modulo', '<>', $id_modulo);
			}])->find($request->Id);

			$toSync = [];

			foreach ($persona->tipo as $tipo) 
			{
				$toSync[] = $tipo['Id_Tipo'];
			}

			$toSync[] = intval($request->Id_Tipo);

			$persona->tipo()->sync($toSync);
			
	        $Mensaje = 'El tipo ha sido asignadas correctamente.';

			$Bandera = 1;

			return response()->json(["Mensaje" => $Mensaje, "Bandera" => $Bandera]);
    	}
	}

	public function moduloActividades()
	{
    	$Actividades = ActividadesSim::join('modulo', 'actividades.Id_Modulo', '=', 'modulo.Id_Modulo')
					    	->where('actividades.Id_Modulo', '=', $this->id_modulo)
					    	->select('actividades.*')
					    	->get();
    	return $Actividades;
	}

	public function personaActividades(Request $request, $id)
	{

	/*$personaActividades = ActividadesSim::with(array('persona' => function($query) use ($id)
	{
	    $query->where('Id_Persona', $id); 
	}))->get();*/
 		$id_modulo = $this->id_modulo ;
		$personaActividades = Persona::with(['act' => function($query) use ($id_modulo)
			{
				$query->where('Id_Modulo', $id_modulo)
						->where('Estado', 1);
			}])->find($id);
		//$actividades = $personaActividades['act']->where('Id_Modulo',  u$this->id_modulo)->where('Estado', 1);
		
		return $personaActividades->act;
	}

	public function PersonasActividadesProceso(Request $request)
	{
		$accesoPersona = Persona::with('acceso')->find($request->Id);
		$i=0;
		if(isset($accesoPersona->acceso))
		{
 			$id_modulo = $this->id_modulo;
			$persona = Persona::with(['act' => function($query) use ($id_modulo)
			{
				$query->where('Id_Modulo', '<>', $id_modulo);
			}])->find($request->Id);

			$toSync = [];

			foreach ($persona->act as $actividad) 
			{
				$toSync[$actividad['Id_Actividad']] = ['Estado' => $actividad->pivot['Estado']];
			}

			foreach ($request->Datos as $datos) 
			{
				$toSync[$datos['id_actividad']] = ['Estado' =>  $datos['estado']];
			}

			$persona->act()->sync($toSync);
			$Mensaje = 'Las acticvidades de '.$accesoPersona['Primer_Nombre'].' '.$accesoPersona['Segundo_Nombre'].' '.$accesoPersona['Primer_Apellido'].' '.$accesoPersona['Segundo_Apellido'].' han sido asignadas correctamente.';
			$Bandera = 1;
		}else{
			$Mensaje = 'Para asignar actividades a '.$accesoPersona['Primer_Nombre'].' '.$accesoPersona['Segundo_Nombre'].' '.$accesoPersona['Primer_Apellido'].' '.$accesoPersona['Segundo_Apellido'].', primero debe contar con acceso al SIM.';
			$Bandera = 0;
		}
			
		return response()->json(["Mensaje" => $Mensaje, "Bandera" => $Bandera]);
	}
}
