<?php
namespace tests;

use Germania\Addresses\AddressInterface;
use Germania\Addresses\AddressAbstract;

class AddressAbstractTest extends \PHPUnit\Framework\TestCase
{

    public function testInstantiation()
    {
        $mock = $this->getMockForAbstractClass(AddressAbstract::class);

        $this->assertInstanceOf( AddressInterface::class, $mock);

        $this->assertObjectHasAttribute('street1',  $mock);
        $this->assertObjectHasAttribute('street2',  $mock);
        $this->assertObjectHasAttribute('zip',      $mock);
        $this->assertObjectHasAttribute('location', $mock);
        $this->assertObjectHasAttribute('country',  $mock);

        return $mock;
    }


    /**
     * @depends testInstantiation
     */
    public function testPropertySetting( $address_abstract )
    {
        $value = "foo";

        $this->assertNotEquals( $address_abstract->getStreet1(), $value);
        $address_abstract->street1 = $value;
        $this->assertEquals( $value, $address_abstract->getStreet1());

        $this->assertNotEquals( $address_abstract->getStreet2(), $value);
        $address_abstract->street2 = $value;
        $this->assertEquals( $value, $address_abstract->getStreet2());

        $this->assertNotEquals( $address_abstract->getZip(), $value);
        $address_abstract->zip = $value;
        $this->assertEquals( $value, $address_abstract->getZip());

        $this->assertNotEquals( $address_abstract->getLocation(), $value);
        $address_abstract->location = $value;
        $this->assertEquals( $value, $address_abstract->getLocation());

        $this->assertNotEquals( $address_abstract->getCountry(), $value);
        $address_abstract->country = $value;
        $this->assertEquals( $value, $address_abstract->getCountry());

    }
}
