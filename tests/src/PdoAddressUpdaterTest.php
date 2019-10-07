<?php
namespace tests;

use Germania\Addresses\PdoAddressUpdater;
use Germania\Addresses\PdoAddressInterface;

class PdoAddressUpdaterTest extends \PHPUnit\Framework\TestCase
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



	public function testInvokation()
	{
		$sut = new PdoAddressUpdater(static::$real_pdo, $GLOBALS['DB_TABLE']);

		$address = $this->prophesize( PdoAddressInterface::class );

		$address->getId()->willReturn( 2 );
		$address->getType()->willReturn("foobar");
		$address->getStreet1()->willReturn("foobar");
		$address->getStreet2()->willReturn("foobar");
		$address->getZip()->willReturn("foobar");
		$address->getLocation()->willReturn("foobar");
		$address->getCountry()->willReturn("foobar");

		$address_result = $sut( $address->reveal() );
		$this->assertIsInt( $address_result );
	}

	public function testExceptionOnExecutionError()
	{
		$stmt = $this->createPdoStatementStub( false, null );
		$pdo = $this->createPdoStub( $stmt );

		$sut = new PdoAddressUpdater($pdo, $GLOBALS['DB_TABLE']);
		
		$address = $this->prophesize( PdoAddressInterface::class );
		$address->getId()->willReturn( 2 );
		$address->getType()->willReturn("foobar");
		$address->getStreet1()->willReturn("foobar");
		$address->getStreet2()->willReturn("foobar");
		$address->getZip()->willReturn("foobar");
		$address->getLocation()->willReturn("foobar");
		$address->getCountry()->willReturn("foobar");

		$this->expectException( \RuntimeException::class );
		$sut( $address->reveal() );
	}

	public function testExceptionOnEmptyGetIdCall()
	{
		$stmt = $this->createPdoStatementStub( false, null );
		$pdo = $this->createPdoStub( $stmt );

		$sut = new PdoAddressUpdater($pdo, $GLOBALS['DB_TABLE']);
		
		$address = $this->prophesize( PdoAddressInterface::class );
		$address->getId()->willReturn( null );

		$this->expectException( \UnexpectedValueException::class );
		$sut( $address->reveal() );
	}	
}