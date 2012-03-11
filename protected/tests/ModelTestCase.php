<?php

require_once 'PHPUnit/Framework/TestSuite.php';

require_once __DIR__ . '/unit/UserTest.php';
require_once __DIR__ . '/unit/AdventureTest.php';
require_once __DIR__ . '/unit/AdventureStepTest.php';

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
		$this->addTestSuite ( 'AdventureTest' );
		$this->addTestSuite ( 'AdventureStepTest' );
	
	}
	
	/**
	 * Creates the suite.
	 */
	public static function suite() {
		return new self ();
	}
}

