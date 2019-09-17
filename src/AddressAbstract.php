<?php
namespace Germania\Addresses;


abstract class AddressAbstract implements AddressInterface
{

	/**
	 * @var string
	 */
	public $street1;

	/**
	 * @var string
	 */
	public $street2;

	/**
	 * @var string
	 */
	public $zip;

	/**
	 * @var string
	 */
	public $location;

	/**
	 * @var string
	 */
	public $country;



	/**
	 * @inheritDoc
	 */
	public function getStreet1()  : ?string
	{
		return $this->street1;
	}
	
	/**
	 * @inheritDoc
	 */
	public function getStreet2()  : ?string
	{
		return $this->street2;
	}
	
	/**
	 * @inheritDoc
	 */
	public function getZip()      : ?string
	{
		return $this->zip;
	}
	
	/**
	 * @inheritDoc
	 */
	public function getLocation() : ?string
	{
		return $this->location;
	}
	
	/**
	 * @inheritDoc
	 */
	public function getCountry()  : ?string
	{
		return $this->country;
	}
}