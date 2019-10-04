<?php
namespace Germania\Addresses;


/**
 * Creates AddressInterface instances from an associative array.
 *
 * Example:
 *
 *     <?php
 *     $factory = (new AddressFactory)([
 *       'street1'  => 'Street name 1',
 *       'street2'  => null,
 *       'zip'      => 'DG2JQ',
 *       'location' => 'Dumfries',
 *       'country'  => 'Scotland'
 *     ]);
 *
 */
class AddressFactory
{
    public $php_address_class;


    /**
     * @param string|null $address_class
     */
    public function __construct(string $address_class = null)
    {
        $this->php_address_class = $address_class ?: Address::class ;
    }


    /**
     * @param  array  $address_data
     * @return AddressInterface
     */
    public function __invoke(array $address_data = array()) : AddressInterface
    {
        $raw = array_merge(array(
            'street1'  => null,
            'street2'  => null,
            'zip'      => null,
            'location' => null,
            'country'  => null,
        ), $address_data);

        $address = new $this->php_address_class;

        $address->setStreet1($raw['street1'])
                 ->setStreet2($raw['street2'])
                 ->setZip($raw['zip'])
                 ->setLocation($raw['location'])
                 ->setCountry($raw['country']);

        return $address;
    }
}
