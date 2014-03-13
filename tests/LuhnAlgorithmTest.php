<?php

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-02-04 at 21:57:34.
 */
class LuhnAlgorithmTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var LuhnAlgorithm
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->object = new LuhnAlgorithm("410321-9202", true);
	}

	public function provider() {
		$data = array();
		$data[] = array("410321-9202");
		$data[] = array("410321 - 9202");
		$data[] = array(4103219202);
		return $data;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		
	}

	/**
	 * @covers LuhnAlgorithm::isValid
	 * @dataProvider provider
	 */
	public function testIsValid($number) {
		$this->object->setNumber($number, true);
		$this->assertTrue($this->object->isValid());
	}

	/**
	 * @covers LuhnAlgorithm::calculateChecksum
	 * @dataProvider provider
	 */
	public function testCalculateChecksum($number) {
		$number = \LuhnAlgorithm::toInteger($number);
		$checkSum = \LuhnAlgorithm::calculateChecksum($number);
		$this->assertEquals(0, $checkSum % 10);
	}

	/**
	 * @covers LuhnAlgorithm::calculcateCheckDigit
	 * @dataProvider provider
	 */
	public function testCalculcateCheckDigit($number) {
		$number = strval(\LuhnAlgorithm::toInteger($number));
		$last = strlen($number) - 1;
		
		// Check digit is the last number
		$checkDigit = $number[$last];
		$number = substr($number, 0, $last);
		
		$calcCheckDigit = \LuhnAlgorithm::calculcateCheckDigit($number);
		$this->assertEquals($checkDigit, $calcCheckDigit);
	}

	/**
	 * @covers LuhnAlgorithm::isValidCheckDigit
	 * @dataProvider provider
	 */
	public function testIsValidCheckDigit($number) {
		$this->object->setNumber($number, true);
		$this->assertTrue($this->object->isValidCheckDigit());
	}

	/**
	 * @covers LuhnAlgorithm::isCompletelyValid
	 * @dataProvider provider
	 */
	public function testIsCompletelyValid($number) {
		$this->object->setNumber($number, true);
		$this->assertTrue($this->object->isCompletelyValid());
	}

	/**
	 * @covers LuhnAlgorithm::getNumber
	 * @dataProvider provider
	 */
	public function testGetNumber($number) {
		$this->object->setNumber($number, true);
		$number = \LuhnAlgorithm::toInteger($number);
		$this->assertEquals($number, $this->object->getNumber());
	}

	/**
	 * @covers LuhnAlgorithm::getCheckDigit
	 * @dataProvider provider
	 */
	public function testGetCheckDigit($number) {
		$number = strval($number);
		$checkDigit = $number[strlen($number) - 1];
		$this->object->setNumber($number, true);
		$this->assertEquals($this->object->getCheckDigit(), $checkDigit);
	}

	/**
	 * @covers LuhnAlgorithm::stringToInteger
	 * @dataProvider provider
	 */
	public function testStringToInteger($number) {
		$int = \LuhnAlgorithm::toInteger($number);
		$this->assertTrue(is_numeric($int));
	}

	/**
	 * @covers LuhnAlgorithm::setNumber
	 */
	public function testSetNumber() {
		$this->object->setNumber("410321-9202");
	}

}
