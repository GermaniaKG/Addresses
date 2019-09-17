<?php
namespace Germania\Addresses;

interface AddressProviderInterface
{

    /**
     * @return AddressInterface|null
     */
    public function getAddress()  : ?AddressInterface;
}
