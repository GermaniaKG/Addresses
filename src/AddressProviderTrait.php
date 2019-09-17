<?php
namespace Germania\Addresses;

trait AddressProviderTrait
{

	/**
	 * @var AddressInterface|null
	 */
	public $address = null;


	/**
	 * @return AddressInterface|null
	 */
	public function getAddress() : ?AddressInterface
	{
		return $this->address;
	}
}