<?php
namespace tests;

use Germania\Addresses\PdoAddressFactory;
use Germania\Addresses\PdoAddressInterface;

class PdoAddressFactoryTest extends \PHPUnit\Framework\TestCase
{

	use MockPdoTrait;


	protected static $real_pdo;

    public static function setUpBeforeClass(): void
    {
        static::$real_pdo = new \PDO( $GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'] );

    }
    public static function tearDownAfterClass(): void
    {
        static::$real_pdo = null;
    }


	public function testInstantiation()
	{
		$stmt = $this->createPdoStatementStub( true, array() );
		$pdo = $this->createPdoStub( $stmt );

		$sut = new PdoAddressFactory($pdo, "table_name");
		$this->assertIsCallable( $sut );
	}

	public function testInvokation()
	{
		$address = $this->prophesize(PdoAddressInterface::class);
		$address_stub = $address->reveal();

		$stmt = $this->createPdoStatementStub( true, $address_stub );
		$pdo = $this->createPdoStub( $stmt );

		$sut = new PdoAddressFactory($pdo, "table_name");

		$address_result = $sut(22);
		$this->assertInstanceOf(PdoAddressInterface::class, $address_result);
		$this->assertEquals($address_result, $address_stub);
	}

	public function testExceptionInvokation()
	{
		$stmt = $this->createPdoStatementStub( false, null );
		$pdo = $this->createPdoStub( $stmt );

		$sut = new PdoAddressFactory($pdo, "table_name");

		$this->expectException( \RuntimeException::class );
		$sut(22);
	}


	public function testReadingInvokation()
	{
		$sut = new PdoAddressFactory(static::$real_pdo, $GLOBALS['DB_TABLE']);
		$address_result = $sut(1);
		$this->assertInstanceOf(PdoAddressInterface::class, $address_result);
	}
}