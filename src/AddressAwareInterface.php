<?php
namespace Germania\Addresses;

interface AddressAwareInterface extends AddressProviderInterface
{

	/**
	 * @param AddressProviderInterface|null $address
	 */
	public function setAddress( ?AddressProviderInterface $address) : self;
}