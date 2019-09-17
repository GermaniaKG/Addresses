<?php
namespace tests;

use Germania\Addresses\AddressFactory;
use Germania\Addresses\AddressInterface;

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


}
