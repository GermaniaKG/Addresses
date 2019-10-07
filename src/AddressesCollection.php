<?php
namespace Germania\Addresses;

class AddressesCollection extends \ArrayIterator implements AddressesCollectionInterface
{


	/**
	 * @inheritDoc
	 */
	public function add( AddressInterface $address)
	{
		$this->append($address);
		return $this;
	}


}