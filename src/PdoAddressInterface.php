<?php
namespace Germania\Addresses;

interface PdoAddressInterface extends AddressInterface
{
	public function getId() : ?int;
}