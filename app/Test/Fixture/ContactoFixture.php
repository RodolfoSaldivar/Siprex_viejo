<?php
/**
 * Contacto Fixture
 */
class ContactoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'tipo_contacto' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'nombre' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'puesto' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'rfc' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'razon_social' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 145, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'correo' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'telefono' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'calle' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 145, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'colonia' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 145, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'municipio' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'estado' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'codigo_postal' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'pais' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'tipo_contacto' => 'Lorem ipsum dolor sit amet',
			'nombre' => 'Lorem ipsum dolor sit amet',
			'puesto' => 'Lorem ipsum dolor sit amet',
			'rfc' => 'Lorem ipsum dolor sit amet',
			'razon_social' => 'Lorem ipsum dolor sit amet',
			'correo' => 'Lorem ipsum dolor sit amet',
			'telefono' => 'Lorem ipsum dolor sit amet',
			'calle' => 'Lorem ipsum dolor sit amet',
			'colonia' => 'Lorem ipsum dolor sit amet',
			'municipio' => 'Lorem ipsum dolor sit amet',
			'estado' => 'Lorem ipsum dolor sit amet',
			'codigo_postal' => 'Lorem ipsum dolor sit amet',
			'pais' => 'Lorem ipsum dolor sit amet',
			'created' => '2016-10-16 20:32:58',
			'modified' => '2016-10-16 20:32:58'
		),
	);

}
