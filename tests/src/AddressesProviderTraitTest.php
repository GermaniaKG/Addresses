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
}