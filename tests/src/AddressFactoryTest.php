<?php
namespace tests;

use Germania\Addresses\AddressFactory;
use Germania\Addresses\AddressInterface;
use Germania\Addresses\AddressProviderInterface;
use Germania\Addresses\Address;
use Germania\Addresses\AddressAbstract;

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
