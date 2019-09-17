<?php
namespace tests;

use Germania\Addresses\AddressInterface;
use Germania\Addresses\AddressProviderInterface;
use Germania\Addresses\Address;
use Germania\Addresses\AddressAbstract;

class AddressTest extends \PHPUnit\Framework\TestCase
{

    public function testInstantiation()
    {
        $sut = new Address;

        $this->assertInstanceOf( AddressInterface::class, $sut);
        $this->assertInstanceOf( AddressProviderInterface::class, $sut);
        $this->assertInstanceOf( AddressAbstract::class, $sut);

        return $sut;
    }


    /**
     * @depends testInstantiation
     */
    public function testAddressProviderInterface( $sut )
    {
        $address = $sut->getAddress();
        $this->assertInstanceOf( AddressInterface::class, $address);
    }


    /**
     * @depends testInstantiation
     */
    public function testPropertySetting( $sut )
    {
        $value = "foo";

        $this->assertNotEquals( $sut->getStreet1(), $value);
        $sut->setStreet1( $value );
        $this->assertEquals( $value, $sut->getStreet1());

        $this->assertNotEquals( $sut->getStreet2(), $value);
        $sut->setStreet2( $value );
        $this->assertEquals( $value, $sut->getStreet2());

        $this->assertNotEquals( $sut->getZip(), $value);
        $sut->setZip( $value );
        $this->assertEquals( $value, $sut->getZip());

        $this->assertNotEquals( $sut->getLocation(), $value);
        $sut->setLocation( $value );
        $this->assertEquals( $value, $sut->getLocation());

        $this->assertNotEquals( $sut->getCountry(), $value);
        $sut->setCountry( $value );
        $this->assertEquals( $value, $sut->getCountry());

    }
}
