<?php
namespace tests;

use Germania\Addresses\AddressInterface;
use Germania\Addresses\PdoAddress;
use Germania\Addresses\Address;
use Germania\Addresses\AddressAbstract;

class PdoAddressTest extends \PHPUnit\Framework\TestCase
{

    public function testInstantiation()
    {
        $sut = new PdoAddress;

        $this->assertInstanceOf( AddressInterface::class, $sut);

        $this->assertNull( $sut->getId() );
        $this->assertEquals( 42, $sut->setId( 42)->getId() );

        return $sut;
    }


}
