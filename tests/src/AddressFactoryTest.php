<?php
namespace tests;

use Germania\Addresses\AddressFactory;
use Germania\Addresses\AddressInterface;
use Germania\Addresses\AddressProviderInterface;
use Germania\Addresses\AddressAwareInterface;
use Germania\Addresses\Address;
use Prophecy\Argument;

class AddressFactoryTest extends \PHPUnit\Framework\TestCase
{

    public function testInstantiation()
    {
        $sut = new AddressFactory;

        $this->assertIsCallable( $sut);

        return $sut;
    }


    /**
     * @depends testInstantiation
     */
    public function testSimple( $sut )
    {
        $address = $sut();
        $this->assertInstanceOf( AddressInterface::class, $address);
    }



    /**
     * @dataProvider provideAddressProviders
     * @depends testInstantiation
     */
    public function testApply( $address_provider, $new_data, $sut )
    {

        $address_provider_result = $sut->apply($address_provider, $new_data);
        $this->assertInstanceOf( AddressProviderInterface::class, $address_provider_result);
        $this->assertSame( $address_provider, $address_provider_result);
    }


    public function provideAddressProviders()
    {
        $new_data = array(
            'street1' => "New Street"
        );
        $address_provider = $this->prophesize( AddressAwareInterface::class );
        $address_provider->getAddress()->willReturn( null );
        $address_provider->setAddress( Argument::any() )->shouldBeCalled();

        $address_provider_stub = $address_provider->reveal();

        $address = new Address;

        return array(
            [ $address_provider_stub, $new_data ],
            [ $address, $new_data ]
        );        
    }

}
