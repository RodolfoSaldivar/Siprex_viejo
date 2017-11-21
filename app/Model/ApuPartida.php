<?php
App::uses('AppModel', 'Model');
/**
 * ApuPartida Model
 *
 */
class ApuPartida extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

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
		),
		'Partida' => array(
			'className' => 'Partida',
			'foreignKey' => 'partida_id',
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
					INSERT INTO ".$this->nombre_bdd.".apu_partidas
						(apu_id, partida_id, cantidad)
					VALUES (
						".$atributos['apu_id'].",
						".$atributos['partida_id'].",
						".$atributos['cantidad']."
					)
				");
			}

			if ($accion == "editar")
			{
				$queryExitosa = $this->query("
					UPDATE ".$this->nombre_bdd.".apu_partidas
					SET cantidad = ".$atributos['cantidad'].",
						partida_id = ".$atributos['partida_id']."
					WHERE apu_id = ".$atributos['apu_id']."
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
