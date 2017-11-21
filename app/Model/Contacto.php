<?php
App::uses('AppModel', 'Model');
/**
 * Contacto Model
 *
 * @property Insumo $Insumo
 */
class Contacto extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Insumo' => array(
			'className' => 'Insumo',
			'foreignKey' => 'contacto_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Empresa' => array(
			'className' => 'Empresa',
			'foreignKey' => 'empresa_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	

//=========================================================================


	public $virtualFields = array(
	    'nombreYpuesto' => "CONCAT(Contacto.nombre, ' / ', Contacto.puesto)"
	);
	

//=========================================================================


	public function todosContactos($empresa_id)
	{
		$contactos = $this->find('all', array(
			'conditions' => array(
				'empresa_id' => $empresa_id
			),
			'fields' => array(
				'id', 'tipo_contacto', 'nombre', 'puesto', 'rfc', 'correo'
			),
			'order' => array('tipo_contacto', 'nombre')
		));

		foreach ($contactos as $key => $contacto)
		{
			$contactos[$key]["Contacto"]["id_original"] = $contacto["Contacto"]["id"];
			$id_encriptada = $this->encriptacion($contacto["Contacto"]["id"]);
			$contactos[$key]["Contacto"]["id"] = $id_encriptada;
		}

		return $contactos;
	}
	

//=========================================================================


	public function contactoEspecifico($id)
	{
		$contacto = $this->find('first', array(
			'conditions' => array('id' => $id),
			'fields' => array(
				'id', 'tipo_contacto', 'nombre', 'puesto', 'rfc', 'razon_social', 'correo', 'telefono', 'calle', 'colonia', 'municipio', 'estado', 'codigo_postal', 'pais'
			)
		));

		return $contacto;
	}
	

//=========================================================================


	public function guardarEnBDD($atributos, $accion)
	{
		$valido = $this->validarInputs($atributos);

		if ($valido != 1)
			return $valido;
		else
		{	
			if ($accion == "agregar")
			{
				$queryExitosa = $this->query("
					INSERT INTO ".$this->nombre_bdd.".contactos
						(empresa_id, tipo_contacto, nombre, puesto, rfc, razon_social, correo, telefono, calle, colonia, municipio, estado, codigo_postal, pais)
					VALUES (
						".$atributos['empresa_id'].",
						'".$atributos['tipo_contacto']."',
						'".$atributos['nombre']."',
						'".$atributos['puesto']."',
						'".$atributos['rfc']."',
						'".$atributos['razon_social']."',
						'".$atributos['correo']."',
						'".$atributos['telefono']."',
						'".$atributos['calle']."',
						'".$atributos['colonia']."',
						'".$atributos['municipio']."',
						'".$atributos['estado']."',
						'".$atributos['codigo_postal']."',
						'".$atributos['pais']."'
					)
				");
			}

			if ($accion == "editar")
			{
				$queryExitosa = $this->query("
					UPDATE ".$this->nombre_bdd.".contactos
					SET tipo_contacto = '".$atributos['tipo_contacto']."',
						nombre = '".$atributos['nombre']."',
						puesto = '".$atributos['puesto']."',
						rfc = '".$atributos['rfc']."',
						razon_social = '".$atributos['razon_social']."',
						correo = '".$atributos['correo']."',
						telefono = '".$atributos['telefono']."',
						calle = '".$atributos['calle']."',
						colonia = '".$atributos['colonia']."',
						municipio = '".$atributos['municipio']."',
						estado = '".$atributos['estado']."',
						codigo_postal = '".$atributos['codigo_postal']."',
						pais = '".$atributos['pais']."'
					WHERE id = ".$atributos['id']."
				");
			}

			if ($queryExitosa)
			{
				return 1;
			}
			else
				return 'No se pudo guardar.';
		}
	}

}
