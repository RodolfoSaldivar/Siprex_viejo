<?php
App::uses('AppModel', 'Model');
/**
 * PreciosUnitario Model
 *
 */
class PreciosUnitario extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'PuInsumo' => array(
			'className' => 'PuInsumo',
			'foreignKey' => 'pu_id',
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
		'AnalisisPreciosU' => array(
			'className' => 'AnalisisPreciosU',
			'foreignKey' => 'apu_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	

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
					INSERT INTO ".$this->nombre_bdd.".precios_unitarios
						(nombre, apu_id)
					VALUES (
						'".$atributos['nombre']."',
						".$atributos['apu_id']."
					)
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
