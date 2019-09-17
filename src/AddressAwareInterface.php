<?php
namespace Germania\Addresses;

interface AddressAwareInterface extends AddressProviderInterface
{

	/**
	 * @param AddressInterface|null $address
	 */
	public function setAddress( ?AddressInterface $address) : self;
}