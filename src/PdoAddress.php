<?php
namespace Germania\Addresses;

class PdoAddress extends Address implements PdoAddressInterface
{
	/**
	 * @var int
	 */
	public $id;


	/**
	 * @return int Database record ID
	 */
	public function getId() : ?int
	{
		return $this->id;
	}


	/**
	 * @param int $id
	 */
	public function setId( $id ) : self
	{
		$this->id = $id;
		return $this;
	}

}