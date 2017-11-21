<?php
/**
 * Insumo Fixture
 */
class InsumoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'tipo_insumo' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'contacto_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'descripcion' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 245, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'tipo' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'marca' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'modelo' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'medida' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'precio_compra' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'precio_venta' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'rendimiento' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'ins_con_id_idx' => array('column' => 'contacto_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'tipo_insumo' => 'Lorem ipsum dolor sit amet',
			'contacto_id' => 1,
			'descripcion' => 'Lorem ipsum dolor sit amet',
			'tipo' => 'Lorem ipsum dolor sit amet',
			'marca' => 'Lorem ipsum dolor sit amet',
			'modelo' => 'Lorem ipsum dolor sit amet',
			'medida' => 'Lorem ipsum dolor sit amet',
			'precio_compra' => 1,
			'precio_venta' => 1,
			'rendimiento' => 1,
			'created' => '2016-10-16 20:33:12',
			'modified' => '2016-10-16 20:33:12'
		),
	);

}
