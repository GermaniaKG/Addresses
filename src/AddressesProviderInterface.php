<?php
namespace Germania\Addresses;

interface AddressesProviderInterface
{

	/**
	 * @return AddressesCollectionInterface
	 */
	public function getAddresses() : AddressesCollectionInterface;
}