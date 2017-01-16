<?php

namespace Idrd\Usuarios\Controllers;

use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Idrd\Usuarios\Repo\ActividadesSim;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class AsignarActividadController extends Controller {

	private $id_modulo;

	
    public function __construct()
    {
        $this->id_modulo = 35;
    }

    public function tipoModulo(){
		$Tipo_Modulo = Tipo::join('modulo', 'tipo.Id_Modulo', '=', 'modulo.Id_Modulo')
					    	->where('tipo.Id_Modulo', '=', $this->id_modulo)
					    	->select('tipo.*')
					    	->get();
        return $Tipo_Modulo;
	}
	public function AdicionTipoPersona(Request $request){
		 $validator = Validator:: make($request->all(),[
            'Id' => 'required',
            'Id_Tipo' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(["Bandera" => 0, "Mensaje" => ", pero ocurrio un error en la validación de la imagen o su tamaño."]);
        }else{        
			$Persona = Persona::find($request->Id);
			$Persona->tipo()->sync([$request->Id_Tipo]);
	        return response()->json(["Bandera" => 1, "Mensaje" => "Perfil añadido con éxito."]);
    	}
	}
	public function moduloActividades(){
    	$Actividades = ActividadesSim::join('modulo', 'actividades.Id_Modulo', '=', 'modulo.Id_Modulo')
					    	->where('actividades.Id_Modulo', '=', $this->id_modulo)
					    	->select('actividades.*')
					    	->get();
    	return $Actividades;
	}
	public function personaActividades(Request $request, $id){
		$personaActividades = Persona::with('Actividades')->find($id);
		$actividades = $personaActividades->Actividades()->where('Id_Modulo', $this->id_modulo)->where('Estado', 1)->get();
		return $actividades;
	}
	public function PersonasActividadesProceso(Request $request){

		$accesoPersona = Persona::with('acceso')->find($request->Id);
		$i=0;
		if(isset($accesoPersona->acceso)){
			$persona = Persona::find($request->Id);
			foreach ($request->Datos as $datos) {
				if($datos['estado'] == 1){
					$aprobadas[$datos['id_actividad']] = array('estado' =>  1);
					$eliminar[$i] = $datos['id_actividad'];
				}else{
					$aprobadas[$datos['id_actividad']] = array('estado' =>  0);
					$eliminar[$i] = $datos['id_actividad'];
				}
				$i++;
			
			}
			$persona->Actividades()->detach($eliminar);
			$persona->Actividades()->attach($aprobadas);
				$Mensaje = 'Las acticvidades de '.$accesoPersona['Primer_Nombre'].' '.$accesoPersona['Segundo_Nombre'].' '.$accesoPersona['Primer_Apellido'].' '.$accesoPersona['Segundo_Apellido'].' han sido asignadas correctamente.';
				$Bandera = 1;
		}else{
			$Mensaje = 'Para asignar actividades a '.$accesoPersona['Primer_Nombre'].' '.$accesoPersona['Segundo_Nombre'].' '.$accesoPersona['Primer_Apellido'].' '.$accesoPersona['Segundo_Apellido'].', primero debe contar con acceso al SIM.';
			$Bandera = 0;
		}		
		return response()->json(["Mensaje" => $Mensaje, "Bandera" => $Bandera]);
	}
}
