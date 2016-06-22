<?php 

namespace Idrd\Usuarios\Repo;

interface PersonaInterface {

	const MODELO_PERSONA = 'modelo_persona';
	const MODELO_TIPO = 'modelo_tipo';
	/**
	 * [guardar Guarda una nueva persona]
	 * @param  [array] $input [Datos de la nueva persona]
	 * @return [mixed]        [Idrd\Usuarios\Repo\Persona si se inserta o false si no se inserta]
	 */
	public function guardar($input);

	/**
	 * [actualizar Actualiza una nueva persona]
	 * @param  [array] $input [Datos de la persona]
	 * @return [mixed]        [Idrd\Usuarios\Repo\Persona si se actualiza o false si no se actualiza]
	 */
	public function actualizar($input);

	/**
	 * [eliminar Eliminar una persona]
	 * @param  [int] $id [id de la persona]
	 * @return [bool]    [true o false]
	 */
	public function eliminar($id);

	/**
	 * [obtener Obtener datos de una persona]
	 * @param  [int] $id [id de la pesona]
	 * @return [mixed]     [Idrd\Usuarios\Repo\Persona o NULL si no existe la persona]
	 */
	public function obtener($id);

	/**
	 * [obtenerPaginados obtener pacientes paginados]
	 * @param  [int] $pagina [pagina actual]
	 * @param  [int] $limite [numero de registros por pagina]
	 * @return [StdClass]    [Objeto para usar en paginador]
	 */
	public function obtenerPaginados($pagina, $limite);

	/**
	 * [buscar Buscar una persona]
	 * @param  [key] $key  [Llave para buscar]
	 * @return [mixed]     [Idrd\Usuarios\Repo\Persona o NULL si no existe la persona]
	 */
	public function buscar($key);


	/**
	 * [buscar una persoan por un tipo persona]
	 * @param  [key] $key  [Llave para buscar]
	 * @return [mixed]     [Idrd\Usuarios\Repo\Persona o NULL si no existe la persona]
	 */
	public function buscarPersonaTipo($id_tipo);



} 