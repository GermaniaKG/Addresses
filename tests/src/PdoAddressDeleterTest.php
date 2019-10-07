<?php
namespace tests;

use Germania\Addresses\PdoAddressInserter;
use Germania\Addresses\PdoAddressDeleter;
use Germania\Addresses\PdoAddressInterface;

class PdoAddressDeleterTest extends \PHPUnit\Framework\TestCase
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
		$sut = new PdoAddressDeleter(static::$real_pdo, $GLOBALS['DB_TABLE']);


		$address = $this->prophesize( PdoAddressInterface::class );
		$address->getId()->willReturn( 2 );
		$address->getType()->willReturn("foobar");
		$address->getStreet1()->willReturn("foobar");
		$address->getStreet2()->willReturn("foobar");
		$address->getZip()->willReturn("foobar");
		$address->getLocation()->willReturn("foobar");
		$address->getCountry()->willReturn("foobar");


		$inserter = new PdoAddressInserter( static::$real_pdo, $GLOBALS['DB_TABLE'] );
		$new_address_id = $inserter( $address->reveal() );


		$delete_address = $this->prophesize( PdoAddressInterface::class );
		$delete_address->getId()->willReturn( $new_address_id );

		$deletion_result = $sut( $delete_address->reveal() );
		$this->assertEquals(1, $deletion_result );


		$not_existing_address = $this->prophesize( PdoAddressInterface::class );
		$not_existing_address->getId()->willReturn( -99 );
		$deletion_result = $sut( $not_existing_address->reveal() );
		$this->assertEquals(0, $deletion_result );
	}


	public function testExceptionOnExecutionError()
	{
		$stmt = $this->createPdoStatementStub( false, null );
		$pdo = $this->createPdoStub( $stmt );

		$sut = new PdoAddressDeleter($pdo, $GLOBALS['DB_TABLE']);
		
		$address = $this->prophesize( PdoAddressInterface::class );
		$address->getId()->willReturn( 2 );

		$this->expectException( \RuntimeException::class );
		$sut( $address->reveal() );
	}


	public function testExceptionOnEmptyGetIdCall()
	{
		$stmt = $this->createPdoStatementStub( false, null );
		$pdo = $this->createPdoStub( $stmt );

		$sut = new PdoAddressDeleter($pdo, $GLOBALS['DB_TABLE']);
		
		$address = $this->prophesize( PdoAddressInterface::class );
		$address->getId()->willReturn( null );

		$this->expectException( \UnexpectedValueException::class );
		$sut( $address->reveal() );
	}	
}