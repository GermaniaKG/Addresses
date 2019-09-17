<?php
namespace tests;

use Germania\Addresses\AddressAwareTrait;
use Germania\Addresses\AddressInterface;
use Germania\Addresses\AddressProviderInterface;

class AddressAwareTraitTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider provideAddressMocks
     */
    public function testGetterAndSetter( $address )
    {
        $mock = $this->getMockForTrait(AddressAwareTrait::class);

        $this->assertNotEquals( $address, $mock->getAddress());

        $mock->setAddress( $address );
        $this->assertEquals( $address, $mock->getAddress());
    }



    /**
     * @dataProvider provideAddressMocks
     */
    public function testSetterWithAddressProviderInterface( $address )
    {
        $aware_mock = $this->getMockForTrait(AddressAwareTrait::class);

        $this->assertNotEquals( $address, $aware_mock->getAddress());

        $address_provider = $this->prophesize( AddressProviderInterface::class );
        $address_provider->getAddress()->willReturn( $address );

        $aware_mock->setAddress( $address_provider->reveal() );
        $this->assertEquals( $address, $aware_mock->getAddress());
    }



    public function provideAddressMocks()
    {
        $address_stub = $this->prophesize( AddressInterface::class );
        $address = $address_stub->reveal();

        return array(
            [ $address ]
        );
    }
}
