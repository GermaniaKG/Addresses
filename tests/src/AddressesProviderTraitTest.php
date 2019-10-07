<?php
namespace tests;

use Germania\Addresses\AddressInterface;
use Germania\Addresses\AddressesProviderTrait;
use Germania\Addresses\AddressesCollectionInterface;

class AddressesProviderTraitTest extends \PHPUnit\Framework\TestCase
{
	public function testSimple()
	{
		$sut = $this->getMockForTrait(AddressesProviderTrait::class);
		$addresses = $sut->getAddresses();

		$this->assertInstanceOf( AddressesCollectionInterface::class, $addresses );
		$this->assertInstanceOf( \Traversable::class, $addresses );
		$this->assertIsIterable( $addresses );
	}	


	/**
	 * @dataProvider provideVariousThings
	 */
	public function testWithChangedAddressesCollectionType( $another_type )
	{
		$sut = $this->getMockForTrait(AddressesProviderTrait::class);
		$sut->addresses = $another_type;
		$addresses = $sut->getAddresses();

		$this->assertInstanceOf( AddressesCollectionInterface::class, $addresses );
		$this->assertInstanceOf( \Traversable::class, $addresses );
		$this->assertIsIterable( $addresses );
	}

	public function provideVariousThings()
	{
		return array(
			[ new \ArrayObject ],
			[ false ]
		);
	}


	/**
	 * @dataProvider provideInvalidThings
	 */
	public function testWithInvalidlyChangedAddressesCollectionType( $another_type )
	{
		$sut = $this->getMockForTrait(AddressesProviderTrait::class);
		$sut->addresses = $another_type;
		$this->expectException( \UnexpectedValueException::class );
		$sut->getAddresses();
	}

	public function provideInvalidThings()
	{
		return array(
			[ "foobar" ]
		);
	}
}