<?php
namespace Germania\Addresses;

interface AddressesCollectionInterface extends \Iterator, \Countable 
{

	/**
	 * @param AddressInterface $address
	 */
	public function add( AddressInterface $address);	
}