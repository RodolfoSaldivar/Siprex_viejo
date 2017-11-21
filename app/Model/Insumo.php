<?php
App::uses('AppModel', 'Model');
/**
 * Insumo Model
 *
 * @property Contacto $Contacto
 */
class Insumo extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'PuInsumo' => array(
			'className' => 'PuInsumo',
			'foreignKey' => 'insumo_id',
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
		'Contacto' => array(
			'className' => 'Contacto',
			'foreignKey' => 'contacto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Empresa' => array(
			'className' => 'Empresa',
			'foreignKey' => 'empresa_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	

//=========================================================================


	public function todosInsumos($empresa_id)
	{
		$insumos = $this->find('all', array(
			'conditions' => array(
				'empresa_id' => $empresa_id
			),
			'fields' => array(
				'id', 'identificador', 'descripcion', 'tipo_insumo', 'precio_compra', 'precio_venta', 'unidad', 'referencia'
			),
			'order' => array('referencia', 'tipo_insumo', 'identificador')
		));

		foreach ($insumos as $key => $insumo)
		{
			$id_encriptada = $this->encriptacion($insumo["Insumo"]["id"]);
			$insumos[$key]["Insumo"]["id"] = $id_encriptada;
		}

		return $insumos;
	}
	

//=========================================================================


	public function insumoEspecifico($id)
	{
		$insumo = $this->find('first', array(
			'conditions' => array('Insumo.id' => $id),
			'fields' => array(
				'id', 'identificador', 'tipo_insumo', 'contacto_id', 'empresa_id', 'descripcion', 'referencia', 'marca', 'modelo', 'cantidad', 'unidad', 'precio_compra', 'precio_venta', "CONCAT(Contacto.nombre, ' / ', Contacto.puesto) as contacto"
			),
			'recursive' => 0
		));

		return $insumo;
	}
	

//=========================================================================


	public function traerInsumos($condiciones)
	{
		$insumos = $this->find('all', array(
			'conditions' => $condiciones,
			'fields' => array(
				'id', 'identificador', 'tipo_insumo', 'contacto_id', 'empresa_id', 'descripcion', 'referencia', 'marca', 'modelo', 'cantidad', 'unidad', 'precio_compra', 'precio_venta'
			)
		));

		foreach ($insumos as $key => $insumo)
		{
			$id_encriptada = $this->encriptacion($insumo["Insumo"]["id"]);
			$insumos[$key]["Insumo"]["id_e"] = $id_encriptada;
		}

		return $insumos;
	}
	

//=========================================================================


	public function guardarEnBDD($atributos, $accion)
	{
		if (empty($atributos["contacto_id"])) $atributos["contacto_id"] = "NULL";

		if (empty($atributos["marca"])) $atributos["marca"] = "NULL";

		if (empty($atributos["modelo"])) $atributos["modelo"] = "NULL";

		$valido = $this->validarInputs($atributos);

		if ($valido != 1)
			return $valido;
		else
		{	
			if ($atributos["marca"] == "NULL") $atributos["marca"] = "";

			if ($atributos["modelo"] == "NULL") $atributos["modelo"] = "";

			if ($accion == "agregar")
			{
				$queryExitosa = $this->query("
					INSERT INTO ".$this->nombre_bdd.".insumos
						(identificador, tipo_insumo, contacto_id, empresa_id, descripcion, referencia, marca, modelo, cantidad, unidad, precio_compra, precio_venta)
					VALUES (
						'".$atributos['identificador']."',
						'".$atributos['tipo_insumo']."',
						".$atributos['contacto_id'].",
						".$atributos['empresa_id'].",
						'".$atributos['descripcion']."',
						'".$atributos['referencia']."',
						'".$atributos['marca']."',
						'".$atributos['modelo']."',
						".$atributos['cantidad'].",
						'".$atributos['unidad']."',
						".$atributos['precio_compra'].",
						".$atributos['precio_venta']."
					)
				");
			}

			if ($accion == "editar")
			{
				$queryExitosa = $this->query("
					UPDATE ".$this->nombre_bdd.".insumos
					SET identificador = '".$atributos['identificador']."',
						tipo_insumo = '".$atributos['tipo_insumo']."',
						contacto_id = ".$atributos['contacto_id'].",
						descripcion = '".$atributos['descripcion']."',
						referencia = '".$atributos['referencia']."',
						marca = '".$atributos['marca']."',
						modelo = '".$atributos['modelo']."',
						cantidad = ".$atributos['cantidad'].",
						unidad = '".$atributos['unidad']."',
						precio_compra = ".$atributos['precio_compra'].",
						precio_venta = ".$atributos['precio_venta']."
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
