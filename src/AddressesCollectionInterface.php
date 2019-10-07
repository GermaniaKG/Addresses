<?php
namespace Germania\Addresses;

interface AddressesCollectionInterface extends \Iterator 
{

	/**
	 * @param AddressInterface $address
	 */
	public function add( AddressInterface $address);	
}