<?php
namespace Germania\Addresses;

interface AddressesAwareInterface extends AddressesProviderInterface
{

	/**
	 * @param iterable $addresses
	 */
	public function setAddresses(iterable $addresses);
}