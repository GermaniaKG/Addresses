<?php
namespace tests;

use Germania\Addresses\AddressInterface;
use Germania\Addresses\AdressTypeFilterIterator;

class AdressTypeFilterIteratorTest extends \PHPUnit\Framework\TestCase
{
	public function testInstantiation()
	{
		$sut = new AdressTypeFilterIterator( new \EmptyIterator, "foobar" );
		$this->assertInstanceOf( \Countable::class, $sut );

		return $sut;
	}


	/**
	 * @dataProvider provideVariousAddresses
	 */
	public function testFilterByTypeString( $addresses, $type, $expected_count )
	{
		$sut = new AdressTypeFilterIterator( $addresses, $type );
		$this->assertEquals( $expected_count, count( $sut ));
	}

	public function provideVariousAddresses()
	{
		$addresses = $this->createAddresses();

		return array(
			[ $addresses, "foo",  1],
			[ $addresses, "bar",  1],
			[ $addresses, "none", 0],
		);
	}


	/**
	 * @dataProvider provideVariousRegexAddresses
	 */
	public function testFilterByTypeRegex( $addresses, $type, $expected_count )
	{
		$sut = new AdressTypeFilterIterator( $addresses, $type, "use_regex" );
		$this->assertEquals( $expected_count, count( $sut ));
	}

	public function provideVariousRegexAddresses()
	{
		$addresses = $this->createAddresses();

		return array(
			[ $addresses, "/foo/",  1],
			[ $addresses, "/bar/",  3],
			[ $addresses, "/bar$/",  1],
			[ $addresses, "/none/", 0],
			[ $addresses, "/bar\d+/", 2],
		);
	}


	protected function createAddresses()
	{
        $a1 = $this->prophesize( AddressInterface::class );
        $a1->getType()->willReturn( "foo" );

        $a2 = $this->prophesize( AddressInterface::class );
        $a2->getType()->willReturn( "bar" );

        $a3 = $this->prophesize( AddressInterface::class );
        $a3->getType()->willReturn( "bar01" );

        $a4 = $this->prophesize( AddressInterface::class );
        $a4->getType()->willReturn( "bar02" );

        return new \ArrayIterator([
        	$a1->reveal(),
        	$a2->reveal(),
        	$a3->reveal(),
        	$a4->reveal(),
        	"invalid_type"
        ]);
	}
}