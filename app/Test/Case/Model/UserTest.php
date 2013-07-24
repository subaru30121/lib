<?php
App::uses('User', 'Model');

/**
 * User Test Case
 *
 */
class UserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user',
		'app.group'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->User = ClassRegistry::init('User');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->User);

		parent::tearDown();
	}

/**
 * testCorrespond method
 *
 * @return void
 */
	public function testCorrespond() {
	}

/**
 * testParentNode method
 *
 * @return void
 */
	public function testParentNode() {
	}

/**
 * testPasswordValidateChange method
 *
 * @return void
 */
	public function testPasswordValidateChange() {
	}

/**
 * testUsernameValidateChange method
 *
 * @return void
 */
	public function testUsernameValidateChange() {
	}

}
