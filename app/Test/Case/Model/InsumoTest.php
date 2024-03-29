<?php
App::uses('Insumo', 'Model');

/**
 * Insumo Test Case
 */
class InsumoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.insumo',
		'app.contacto'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Insumo = ClassRegistry::init('Insumo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Insumo);

		parent::tearDown();
	}

}
