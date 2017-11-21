<?php
App::uses('AppModel', 'Model');
App::uses('Presupuesto', 'Model');
App::uses('Partida', 'Model');
App::uses('ApuPartida', 'Model');
App::uses('AnalisisPreciosU', 'Model');
App::uses('PreciosUnitario', 'Model');
App::uses('PuInsumo', 'Model');
App::uses('Insumo', 'Model');
App::uses('Contacto', 'Model');
App::uses('User', 'Model');
/**
 * Empresa Model
 *
 * @property Insumo $Insumo
 * @property User $User
 */
class Empresa extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Insumo' => array(
			'className' => 'Insumo',
			'foreignKey' => 'empresa_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'AnalisisPreciosU' => array(
			'className' => 'AnalisisPreciosU',
			'foreignKey' => 'empresa_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'empresa_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Contacto' => array(
			'className' => 'Contacto',
			'foreignKey' => 'empresa_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Partida' => array(
			'className' => 'Partida',
			'foreignKey' => 'empresa_id',
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
					INSERT INTO ".$this->nombre_bdd.".empresas
						(nombre, mail, fecha_corte, usuarios)
					VALUES (
						'".$atributos['nombre']."',
						'".$atributos['mail']."',
						'".$atributos['fecha_corte']."',
						".$atributos['usuarios']."
					)
				");
			}

			if ($accion == "editar")
			{
				$queryExitosa = $this->query("
					UPDATE ".$this->nombre_bdd.".empresas
					SET nombre = '".$atributos['nombre']."',
						mail = '".$atributos['mail']."',
						fecha_corte = '".$atributos['fecha_corte']."',
						usuarios = ".$atributos['usuarios']."
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
	

//=========================================================================


	public function borrarTodo($empresa_id)
	{
		$Presupuesto = new Presupuesto();
		$Partida = new Partida();
		$ApuPartida = new ApuPartida();
		$AnalisisPreciosU = new AnalisisPreciosU();
		$PreciosUnitario = new PreciosUnitario();
		$PuInsumo = new PuInsumo();
		$Insumo = new Insumo();
		$Contacto = new Contacto();
		$User = new User();
		


		$presupuestos = $Presupuesto->find('all', array(
			'conditions' => array('empresa_id' => $empresa_id),
			'fields' => array('id')
		));
		foreach ($presupuestos as $keyP => $presupuesto)
		{
			$this->query("
				DELETE FROM ".$this->nombre_bdd.".presupuestos
				WHERE id = ".$presupuesto["Presupuesto"]["id"]."
			");
		}
		


		$partidas = $Partida->find('all', array(
			'conditions' => array('empresa_id' => $empresa_id),
			'fields' => array('id')
		));
		foreach ($partidas as $keyP => $partida)
		{
			$apu_par = $ApuPartida->find('all', array(
				'conditions' => array('partida_id' => $partida["Partida"]["id"]),
				'fields' => array('id')
			));

			foreach ($apu_par as $keyAP => $value)
			{
				$this->query("
					DELETE FROM ".$this->nombre_bdd.".apu_partidas
					WHERE id = ".$value["ApuPartida"]["id"]."
				");
			}

			$this->query("
				DELETE FROM ".$this->nombre_bdd.".partidas
				WHERE id = ".$partida["Partida"]["id"]."
			");
		}
		


		$analisis_precios_us = $AnalisisPreciosU->find('all', array(
			'conditions' => array('empresa_id' => $empresa_id),
			'fields' => array('id')
		));
		foreach ($analisis_precios_us as $keyP => $apu)
		{
			$apu_pus = $PreciosUnitario->find('all', array(
				'conditions' => array('apu_id' => $apu["AnalisisPreciosU"]["id"]),
				'fields' => array('id')
			));

			foreach ($apu_pus as $keyAP => $apu_pu)
			{
				$pu_ins = $PuInsumo->find('all', array(
					'conditions' => array('pu_id' => $apu_pu["PreciosUnitario"]["id"]),
					'fields' => array('id')
				));

				foreach ($pu_ins as $keyPI => $value)
				{
					$this->query("
						DELETE FROM ".$this->nombre_bdd.".pu_insumos
						WHERE id = ".$value["PuInsumo"]["id"]."
					");
				}

				$this->query("
					DELETE FROM ".$this->nombre_bdd.".precios_unitarios
					WHERE id = ".$apu_pu["PreciosUnitario"]["id"]."
				");
			}

			$this->query("
				DELETE FROM ".$this->nombre_bdd.".analisis_precios_us
				WHERE id = ".$apu["AnalisisPreciosU"]["id"]."
			");
		}
		


		$insumos = $Insumo->find('all', array(
			'conditions' => array('empresa_id' => $empresa_id),
			'fields' => array('id')
		));
		foreach ($insumos as $keyP => $insumo)
		{
			$this->query("
				DELETE FROM ".$this->nombre_bdd.".insumos
				WHERE id = ".$insumo["Insumo"]["id"]."
			");
		}
		


		$contactos = $Contacto->find('all', array(
			'conditions' => array('empresa_id' => $empresa_id),
			'fields' => array('id')
		));
		foreach ($contactos as $keyP => $contacto)
		{
			$this->query("
				DELETE FROM ".$this->nombre_bdd.".contactos
				WHERE id = ".$contacto["Contacto"]["id"]."
			");
		}
		


		$users = $User->find('all', array(
			'conditions' => array('empresa_id' => $empresa_id),
			'fields' => array('id')
		));
		foreach ($users as $keyP => $user)
		{
			$this->query("
				DELETE FROM ".$this->nombre_bdd.".users
				WHERE id = ".$user["User"]["id"]."
			");
		}



		$this->query("
			DELETE FROM ".$this->nombre_bdd.".empresas
			WHERE id = ".$empresa_id."
		");
	}

}
