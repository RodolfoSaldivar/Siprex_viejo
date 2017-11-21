<?php
App::uses('AppModel', 'Model');
App::uses('Partida', 'Model');
/**
 * Presupuesto Model
 *
 */
class Presupuesto extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

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


	public function traerPresupuestos($condiciones, $empresa_id)
	{
		$Partida = new Partida();

		$presupuestos = $this->find("all", array(
			'conditions' => $condiciones,
			'fields' => array(
				'id', 'obra', 'colonia', 'ubicacion', 'contratista'
			),
			'order' => array('obra')
		));

		foreach ($presupuestos as $keyP => $presupuesto)
		{
			$acum = 0;

			$condiciones = array('empresa_id' => $empresa_id);
			$partidas = $Partida->traerPartidas($condiciones, $presupuesto["Presupuesto"]["id"]);

			foreach ($partidas as $keyPa => $partida)
			{
				$acum+= $partida["Partida"]["importe"];
			}

			$id_encriptada = $this->encriptacion($presupuesto["Presupuesto"]["id"]);
			$presupuestos[$keyP]["Presupuesto"]["id"] = $id_encriptada;

			$presupuestos[$keyP]["Presupuesto"]["importe"] = $acum;
		}

		return $presupuestos;
	}
	

//=========================================================================


	public function traerUnico($condiciones, $empresa_id)
	{
		$Partida = new Partida();

		$presupuesto = $this->find("first", array(
			'conditions' => $condiciones,
			'fields' => array(
				'id', 'obra', 'colonia', 'ubicacion', 'contratista'
			),
			'order' => array('obra')
		));

		$acum = 0;

		$condiciones = array('empresa_id' => $empresa_id);
		$partidas = $Partida->traerPartidas($condiciones, $presupuesto["Presupuesto"]["id"]);

		foreach ($partidas as $keyPa => $partida)
		{
			$acum+= $partida["Partida"]["importe"];
		}

		$presupuesto["Partidas"] = $partidas;

		$id_encriptada = $this->encriptacion($presupuesto["Presupuesto"]["id"]);
		$presupuesto["Presupuesto"]["id"] = $id_encriptada;

		$presupuesto["Presupuesto"]["importe"] = $acum;

		return $presupuesto;
	}
	

//=========================================================================


	public function guardarEnBDD($data, $accion)
	{
		$valido = $this->validarInputs($data['Presupuesto']);

		if ($valido != 1)
			return $valido;
		else
		{	
			if ($accion == "agregar")
			{
				$queryExitosa = $this->query("
					INSERT INTO ".$this->nombre_bdd.".presupuestos
						(obra, colonia, ubicacion, empresa_id, contratista)
					VALUES (
						'".$data['Presupuesto']['obra']."',
						'".$data['Presupuesto']['colonia']."',
						'".$data['Presupuesto']['ubicacion']."',
						".$data['Presupuesto']['empresa_id'].",
						'".$data['Presupuesto']['contratista']."'
					)
				");
			}

			if ($accion == "editar")
			{
				$queryExitosa = $this->query("
					UPDATE ".$this->nombre_bdd.".presupuestos
					SET obra = '".$data['Presupuesto']['obra']."',
						colonia = '".$data['Presupuesto']['colonia']."',
						ubicacion = '".$data['Presupuesto']['ubicacion']."',
						contratista = '".$data['Presupuesto']['contratista']."'
					WHERE id = ".$data['Presupuesto']['id']."
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
