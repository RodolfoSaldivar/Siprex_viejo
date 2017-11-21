<?php
App::uses('Contacto', 'Model');

/**
 * Contacto Test Case
 */
class ContactoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.contacto',
		'app.insumo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Contacto = ClassRegistry::init('Contacto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Contacto);

		parent::tearDown();
	}

}
