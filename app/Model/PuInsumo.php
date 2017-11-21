<?php
App::uses('AppModel', 'Model');
/**
 * PuInsumo Model
 *
 */
class PuInsumo extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'PreciosUnitario' => array(
			'className' => 'PreciosUnitario',
			'foreignKey' => 'pu_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Insumo' => array(
			'className' => 'Insumo',
			'foreignKey' => 'insumo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
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
					INSERT INTO ".$this->nombre_bdd.".pu_insumos
						(pu_id, insumo_id, cantidad, importe)
					VALUES (
						".$atributos['pu_id'].",
						".$atributos['insumo_id'].",
						".$atributos['cantidad'].",
						".$atributos['importe']."
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
