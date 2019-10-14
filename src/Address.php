<?php
namespace Germania\Addresses;

class Address extends AddressAbstract implements AddressInterface, AddressProviderInterface
{

    /**
     * @inheritDoc
     */
    public function getAddress()  : ?AddressInterface
    {
        return $this;
    }


    /**
     * @param string $type|null
     * @return self Fluent interface
     */
    public function setType(?string $type)  : self
    {
        $this->type = $type;
        return $this;
    }
    

    /**
     * @param string $street1|null
     * @return self Fluent interface
     */
    public function setStreet1(?string $street1)  : self
    {
        $this->street1 = $street1;
        return $this;
    }
    

    /**
     * @param string $street2|null
     * @return self Fluent interface
     */
    public function setStreet2(?string $street2)  : self
    {
        $this->street2 = $street2;
        return $this;
    }
    

    /**
     * @param string $zip|null
     * @return self Fluent interface
     */
    public function setZip(?string $zip)      : self
    {
        $this->zip = $zip;
        return $this;
    }
    

    /**
     * @param string $location|null
     * @return self Fluent interface
     */
    public function setLocation(?string $location) : self
    {
        $this->location = $location;
        return $this;
    }
    

    /**
     * @param string $country|null
     * @return self Fluent interface
     */
    public function setCountry(?string $country)  : self
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return inheritDoc
     */
    public function isEmpty() : bool {
        return (empty( trim($this->street1) )
           and empty( trim($this->street2) )
           and empty( trim($this->zip) )
           and empty( trim($this->location) ));
    }    
}
