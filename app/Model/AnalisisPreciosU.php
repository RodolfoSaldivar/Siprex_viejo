<?php
App::uses('AppModel', 'Model');
App::uses('PreciosUnitario', 'Model');
App::uses('ApuPartida', 'Model');
App::uses('PuInsumo', 'Model');
App::uses('Insumo', 'Model');
/**
 * AnalisisPreciosU Model
 *
 */
class AnalisisPreciosU extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'PreciosUnitario' => array(
			'className' => 'PreciosUnitario',
			'foreignKey' => 'apu_id',
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
		'ApuPartida' => array(
			'className' => 'ApuPartida',
			'foreignKey' => 'apu_id',
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


	public function activarDesactivar($id, $estatus)
	{
		$queryExitosa = $this->query("
			UPDATE ".$this->nombre_bdd.".analisis_precios_us
			SET activo = $estatus
			WHERE id = $id
		");
	}
	

//=========================================================================


	public function busquedaFiltro($condiciones)
	{
		$apus = $this->find("all", array(
			'conditions' => $condiciones,
			'fields' => array(
				'id', 'clave', 'descripcion', 'unidad', 'costo_indirecto', 'costo_financiero', 'costo_utilidad', 'importe', 'presupuesto_id', 'activo'
			),
			'order' => array('clave')
		));

		return $this->incluirTotal($apus);
	}
	

//=========================================================================


	public function incluirTotal($apus)
	{	
		$PreciosUnitario = new PreciosUnitario();
		$PuInsumo = new PuInsumo();

		foreach ($apus as $keyApu => $apu)
		{
			$id_encriptada = $this->encriptacion($apu["AnalisisPreciosU"]["id"]);
			$apus[$keyApu]["AnalisisPreciosU"]["id"] = $id_encriptada;
		}

		return $apus;
	}
	

//=========================================================================


	public function apuEspecifico($id)
	{
		$PreciosUnitario = new PreciosUnitario();
		$ApuPartida = new ApuPartida();
		$PuInsumo = new PuInsumo();

		$apu = $ApuPartida->find("first", array(
			'recursive' => 0,
			'conditions' => array(
				'AnalisisPreciosU.id' => $id
			),
			'fields' => array(
				'AnalisisPreciosU.id', 'AnalisisPreciosU.clave', 'AnalisisPreciosU.descripcion', 'AnalisisPreciosU.unidad', 'AnalisisPreciosU.costo_indirecto', 'AnalisisPreciosU.costo_financiero', 'AnalisisPreciosU.costo_utilidad', 'ApuPartida.cantidad', 'ApuPartida.partida_id'
			)
		));

		$apu["PU"] = $PreciosUnitario->find("all", array(
			'conditions' => array('apu_id' => $id),
			'fields' => array('id', 'nombre')
		));

		$cont_apu = 0;

		foreach ($apu["PU"] as $keyPu => $pu)
		{	
			$cont_pu = 0;

			$apu["PU"][$keyPu]["Insumos"] = $PuInsumo->find("all", array(
				'recursive' => 0,
				'conditions' => array(
					'pu_id' => $pu["PreciosUnitario"]["id"]
				),
				'fields' => array(
					'Insumo.identificador', 'Insumo.descripcion', 'Insumo.unidad', 'PuInsumo.cantidad', 'PuInsumo.importe'
				)
			));

			foreach ($apu["PU"][$keyPu]["Insumos"] as $keyIn => $insumo)
			{
				$cont_pu+= $insumo["PuInsumo"]["cantidad"] * $insumo["PuInsumo"]["importe"];
			}

			$apu["PU"][$keyPu]["PreciosUnitario"]["total"] = $cont_pu;
			$cont_apu+= $cont_pu;
		}

		$apu["AnalisisPreciosU"]["costo_directo"] = $cont_apu;

		return $apu;
	}
	

//=========================================================================


	public function guardarEnBDD($data, $accion)
	{
		$valido = $this->validarInputs($data['APU']);

		if ($valido != 1)
			return $valido;
		else
		{	
			if ($accion == "agregar")
			{
				$queryExitosa = $this->query("
					INSERT INTO ".$this->nombre_bdd.".analisis_precios_us
						(clave, descripcion, unidad, costo_indirecto, costo_financiero, costo_utilidad, empresa_id, presupuesto_id, activo)
					VALUES (
						'".$data['APU']['clave']."',
						'".$data['APU']['descripcion']."',
						'".$data['APU']['unidad']."',
						".$data['APU']['costo_indirecto'].",
						".$data['APU']['costo_financiero'].",
						".$data['APU']['costo_utilidad'].",
						".$data['APU']['empresa_id'].",
						".$data['APU']['presupuesto_id'].",
						1
					)
				");
			}

			if ($accion == "editar")
			{
				$this->borrarHijos($data['APU']['id']);

				$queryExitosa = $this->query("
					UPDATE ".$this->nombre_bdd.".analisis_precios_us
					SET clave = '".$data['APU']['clave']."',
						descripcion = '".$data['APU']['descripcion']."',
						unidad = '".$data['APU']['unidad']."',
						costo_indirecto = ".$data['APU']['costo_indirecto'].",
						costo_financiero = ".$data['APU']['costo_financiero'].",
						costo_utilidad = ".$data['APU']['costo_utilidad'].",
						activo = 1
					WHERE id = ".$data['APU']['id']."
				");
			}

			if ($queryExitosa)
			{
				$PreciosUnitario = new PreciosUnitario();
				$PuInsumo = new PuInsumo();
				$Insumo = new Insumo();

				$apu_creado = $this->find("first", array(
					'conditions' => array(
						'clave' => strval($data['APU']['clave']),
						'empresa_id' => $data['APU']['empresa_id'],
						'presupuesto_id' => $data["APU"]["presupuesto_id"]
					),
					'fields' => array('id')
				));
				$apu_creado = $apu_creado["AnalisisPreciosU"]["id"];
				
				$apu_importe = 0;
				$todo_correcto = 1;
				if (!empty($data["PU"]))
				foreach ($data["PU"] as $keyPU => $precio_unitario)
				{
					$datos_pu["apu_id"] = $apu_creado;
					$datos_pu["nombre"] = $precio_unitario["nombre"];

					$pu_guardado = $PreciosUnitario->guardarEnBDD($datos_pu, "agregar");

					if ($pu_guardado != 1)
						return $pu_guardado;	
					else
					{
						$pu_creado = $PreciosUnitario->find("first", array(
							'conditions' => array(
								'apu_id' => strval($datos_pu['apu_id']),
								'nombre' => $datos_pu['nombre']
							),
							'order' => array('id' => 'DESC'),
							'fields' => array('id')
						));
						$pu_creado = $pu_creado["PreciosUnitario"]["id"];

						if (!empty($precio_unitario["Insumos"]))
						{
							foreach ($precio_unitario["Insumos"] as $identificador => $cantidad)
							{
								$insumo_id = $Insumo->find("first", array(
									'conditions' => array(
										'identificador' => strval($identificador),
										'empresa_id' => $data['APU']['empresa_id']
									),
									'fields' => array('id', 'precio_venta')
								));
								$insumo_precio = $insumo_id["Insumo"]["precio_venta"];
								$insumo_id = $insumo_id["Insumo"]["id"];

								$datos_puins["pu_id"] = $pu_creado;
								$datos_puins["insumo_id"] = $insumo_id;
								$datos_puins["cantidad"] = $cantidad;
								$datos_puins["importe"] = $insumo_precio;
								$apu_importe+= $insumo_precio * $cantidad;

								$puins_guardado = $PuInsumo->guardarEnBDD($datos_puins, "agregar");
								if ($puins_guardado != 1)
									$todo_correcto = 0;
							}
						}

						if (!$todo_correcto)
							return "Algo salio mal.";
					}
				}

				$importe_apu = $apu_importe;

				$costo_indirecto = $importe_apu * ($data["APU"]["costo_indirecto"] / 100 + 1);
				$costo_financiero = $costo_indirecto * ($data["APU"]["costo_financiero"] / 100 + 1);
				$costo_utilidad = $costo_financiero * ($data["APU"]["costo_utilidad"] / 100 + 1);

				$apu_importe = round($costo_utilidad, 2);

				$queryExitosa = $this->query("
					UPDATE ".$this->nombre_bdd.".analisis_precios_us
					SET importe = $apu_importe
					WHERE id = $apu_creado
				");

				if (!$queryExitosa)
					$todo_correcto = 0;

				if ($todo_correcto)
					return 1;
				else
					return "Algo salio mal.";
			}
			else
				return 'No se pudo guardar.';
		}
	}
	

//=========================================================================


	private function borrarHijos($apu_id)
	{
		$PreciosUnitario = new PreciosUnitario();
		$PuInsumo = new PuInsumo();

		$pus = $PreciosUnitario->find("list", array(
			'conditions' => array('apu_id' => $apu_id),
			'fields' => array('id', 'id')
		));

		foreach ($pus as $keyP => $pu_id)
		{
			$pu_insumos = $PuInsumo->find("list", array(
				'conditions' => array('pu_id' => $pu_id),
				'fields' => array('id', 'id')
			));

			foreach ($pu_insumos as $keyPI => $puins_id)
			{
				$PuInsumo->query("
					DELETE FROM ".$this->nombre_bdd.".pu_insumos
					WHERE id = $puins_id
				");
			}

			$PreciosUnitario->query("
				DELETE FROM ".$this->nombre_bdd.".precios_unitarios
				WHERE id = $pu_id
			");
		}
	}
}
