<?php
namespace Germania\Addresses;

interface AddressInterface extends AddressProviderInterface
{

    /**
     * @return string|null
     */
    public function getType()  : ?string;
    
    /**
     * @return string|null
     */
    public function getStreet1()  : ?string;
    
    /**
     * @return string|null
     */
    public function getStreet2()  : ?string;
    
    /**
     * @return string|null
     */
    public function getZip()      : ?string;
    
    /**
     * @return string|null
     */
    public function getLocation() : ?string;
    
    /**
     * @return string|null
     */
    public function getCountry()  : ?string;

    /**
     * Returns TRUE if address data is empty.
     * 
     * @return boolean
     */
    public function isEmpty() : bool;
}
