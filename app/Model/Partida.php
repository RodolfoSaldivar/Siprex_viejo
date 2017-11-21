<?php
App::uses('AppModel', 'Model');
App::uses('AnalisisPreciosU', 'Model');
App::uses('ApuPartida', 'Model');
/**
 * Partida Model
 *
 */
class Partida extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ApuPartida' => array(
			'className' => 'ApuPartida',
			'foreignKey' => 'partida_id',
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


	public function soloPartidas($condiciones)
	{
		$partidas = $this->find("list", array(
			'conditions' => $condiciones,
			'fields' => array(
				'id', 'nombre'
			),
			'order' => array('nombre')
		));

		return $partidas;
	}
	

//=========================================================================


	public function traerPartidas($condiciones, $presupuesto_id)
	{
		$AnalisisPreciosU = new AnalisisPreciosU();
		$ApuPartida = new ApuPartida();

		$partidas = $this->find("all", array(
			'conditions' => $condiciones,
			'fields' => array(
				'id', 'identificador', 'nombre'
			),
			'order' => array('identificador')
		));

		foreach ($partidas as $keyP => $partida)
		{
			$acum_partida = 0;

			$apu_partidas = $ApuPartida->find("all", array(
				'recursive' => 0,
				'conditions' => array(
					'partida_id' => $partida["Partida"]["id"],
					'presupuesto_id' => $presupuesto_id
				),
				'fields' => array(
					'ApuPartida.id', 'ApuPartida.cantidad', 'AnalisisPreciosU.id', 'AnalisisPreciosU.clave', 'AnalisisPreciosU.descripcion', 'AnalisisPreciosU.unidad', 'AnalisisPreciosU.costo_indirecto', 'AnalisisPreciosU.costo_financiero', 'AnalisisPreciosU.costo_utilidad', 'AnalisisPreciosU.importe', 'AnalisisPreciosU.activo'
				),
				'order' => array('AnalisisPreciosU.clave')
			));

			$apu_partidas = $AnalisisPreciosU->incluirTotal($apu_partidas);

			foreach ($apu_partidas as $keyAP => $apu_pa)
			{
				if ($apu_pa["AnalisisPreciosU"]["activo"])
					$acum_partida+= $apu_pa["AnalisisPreciosU"]["importe"] * $apu_pa["ApuPartida"]["cantidad"];
			}

			$partidas[$keyP]["AnalisisPreciosU"] = $apu_partidas;
			$partidas[$keyP]["Partida"]["importe"] = $acum_partida;

			$id_encriptada = $this->encriptacion($partida["Partida"]["id"]);
			$partidas[$keyP]["Partida"]["id"] = $id_encriptada;
		}

		return $partidas;
	}
	

//=========================================================================


	public function guardarEnBDD($data, $accion)
	{
		$valido = $this->validarInputs($data['Partida']);

		if ($valido != 1)
			return $valido;
		else
		{	
			if ($accion == "agregar")
			{
				$queryExitosa = $this->query("
					INSERT INTO ".$this->nombre_bdd.".partidas
						(identificador, nombre, empresa_id)
					VALUES (
						'".$data['Partida']['identificador']."',
						'".$data['Partida']['nombre']."',
						".$data['Partida']['empresa_id']."
					)
				");
			}

			if ($accion == "editar")
			{
				// $this->borrarHijos($data['Partida']['id']);

				$queryExitosa = $this->query("
					UPDATE ".$this->nombre_bdd.".partidas
					SET identificador = '".$data['Partida']['identificador']."',
						nombre = '".$data['Partida']['nombre']."'
					WHERE id = ".$data['Partida']['id']."
				");
			}

			if ($queryExitosa)
				return 1;
			else
				return 'No se pudo guardar.';
		}
	}
	

//=========================================================================


	private function borrarHijos($partida_id)
	{
		$ApuPartida = new ApuPartida();

		$apu_par = $ApuPartida->find("list", array(
			'conditions' => array('partida_id' => $partida_id),
			'fields' => array('id', 'id')
		));

		foreach ($apu_par as $keyP => $apu_pa)
		{
			$ApuPartida->query("
				DELETE FROM ".$this->nombre_bdd.".apu_partidas
				WHERE id = $apu_pa
			");
		}
	}

}
