<?php
namespace tests;

use Germania\Addresses\AddressInterface;
use Germania\Addresses\AddressesAwareTrait;
use Germania\Addresses\AddressesCollectionInterface;
use Germania\Addresses\AddressesCollection;

class AddressesAwareTraitTest extends \PHPUnit\Framework\TestCase
{

	/**
	 * @dataProvider provideVariousTypesOfAddressesCollections
	 */
	public function testSimple( $addresses )
	{
		$sut = $this->getMockForTrait(AddressesAwareTrait::class);
		$sut->setAddresses( $addresses );
		$addresses = $sut->getAddresses();

		$this->assertInstanceOf( AddressesCollectionInterface::class, $addresses );
	}

	public function provideVariousTypesOfAddressesCollections()
	{
		$aci = $this->prophesize( AddressesCollectionInterface::class );
		return array(
			[ $aci->reveal() ],
			[ array() ],
			[ new \ArrayObject ],
			[ new \ArrayIterator ],
			[ new AddressesCollection ]
		);
	}


	/**
	 * @dataProvider provideInvalidArguments
	 */
	public function testExceptionOnInvalidArguments( $invalid_arg )
	{
		$sut = $this->getMockForTrait(AddressesAwareTrait::class);
		
		$this->expectException( \TypeError::class );
		$sut->setAddresses( $invalid_arg );
	}

	public function provideInvalidArguments()
	{
		return array(
			[ "foo" ],
			[ null ],
			[ 22 ]
		);
	}
}