<?php
namespace tests;

use Germania\Addresses\PdoAddressInserter;
use Germania\Addresses\PdoAddressInterface;

class PdoAddressInserterTest extends \PHPUnit\Framework\TestCase
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
		$sut = new PdoAddressInserter(static::$real_pdo, $GLOBALS['DB_TABLE']);

		$address = $this->prophesize( PdoAddressInterface::class );

		$address->getType()->willReturn("foobar");
		$address->getStreet1()->willReturn("foobar");
		$address->getStreet2()->willReturn("foobar");
		$address->getZip()->willReturn("foobar");
		$address->getLocation()->willReturn("foobar");
		$address->getCountry()->willReturn("foobar");

		$new_address_id = $sut( $address->reveal() );
		$this->assertIsInt( $new_address_id );

		$delete_query = sprintf("DELETE FROM %s WHERE id = %s", $GLOBALS['DB_TABLE'], $new_address_id);
		static::$real_pdo->query( $delete_query );
	}

	public function testExceptionOnExecutionError()
	{
		$stmt = $this->createPdoStatementStub( false, null );
		$pdo = $this->createPdoStub( $stmt );

		$sut = new PdoAddressInserter($pdo, $GLOBALS['DB_TABLE']);
		
		$address = $this->prophesize( PdoAddressInterface::class );
		$address->getType()->willReturn("foobar");
		$address->getStreet1()->willReturn("foobar");
		$address->getStreet2()->willReturn("foobar");
		$address->getZip()->willReturn("foobar");
		$address->getLocation()->willReturn("foobar");
		$address->getCountry()->willReturn("foobar");

		$this->expectException( \RuntimeException::class );
		$sut( $address->reveal() );
	}
}