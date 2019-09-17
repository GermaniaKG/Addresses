<?php
namespace Germania\Addresses;

trait AddressAwareTrait 
{
	use AddressProviderTrait;


	/**
	 * @param AddressInterface|null $address
	 */
	public function setAddress( ?AddressInterface $address) : self
	{
		$this->address = $address;
		return $this;	
	}
}