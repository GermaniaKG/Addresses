<?php
namespace tests;

use Germania\Addresses\AddressProviderTrait;
use Germania\Addresses\AddressInterface;

class AddressProviderTraitTest extends \PHPUnit\Framework\TestCase
{

    public function testGetInterceptor()
    {
        $provider_mock = $this->getMockForTrait(AddressProviderTrait::class);

        $address_stub = $this->prophesize( AddressInterface::class );
        $address = $address_stub->reveal();

        // Trait introduces this attribute
        $this->assertObjectHasAttribute('address', $provider_mock);
        $provider_mock->address = $address;

        $this->assertEquals( $address, $provider_mock->getAddress());
    }
}
