<?php
namespace Germania\Addresses;

trait AddressAwareTrait
{
    use AddressProviderTrait;


    /**
     * @param AddressProviderInterface|null $address
     */
    public function setAddress(?AddressProviderInterface $address)
    {
        if ($address instanceof AddressInterface):
            $this->address = $address; 
        else:
            $this->address = $address->getAddress();
        endif;

        return $this;
    }
}
