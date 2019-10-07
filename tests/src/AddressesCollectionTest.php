<?php
namespace tests;

use Germania\Addresses\AddressInterface;
use Germania\Addresses\AddressesCollection;
use Germania\Addresses\AddressesCollectionInterface;

class AddressesCollectionTest extends \PHPUnit\Framework\TestCase
{

	public function testInstantiation()
	{
		$sut = new AddressesCollection;
		$this->assertInstanceOf( AddressesCollectionInterface::class, $sut );
		return $sut;
	}


	/**
	 * @depends testInstantiation
	 */
	public function testAddingThings( $sut )
	{
		$address = $this->prophesize( AddressInterface::class );

		$this->assertInstanceOf( \Countable::class, $sut );
		$old_count = count( $sut );
		$sut->add( $address->reveal() );

		$new_count = count( $sut );
		$this->assertEquals( $old_count + 1, $new_count);
	}

}