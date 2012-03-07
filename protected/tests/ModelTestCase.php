<?php

require_once 'PHPUnit/Framework/TestSuite.php';

require_once __DIR__ . '/unit/UserTest.php';

/**
 * Static test suite.
 */
class ModelTestCase extends PHPUnit_Framework_TestSuite {
	
	/**
	 * Constructs the test suite handler.
	 */
	public function __construct() {
		$this->setName ( 'ModelTestCase' );
		
		$this->addTestSuite ( 'UserTest' );
	
	}
	
	/**
	 * Creates the suite.
	 */
	public static function suite() {
		return new self ();
	}
}

