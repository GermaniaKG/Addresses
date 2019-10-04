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

    public $default_data = array(
        'type'     => null,
        'street1'  => null,
        'street2'  => null,
        'zip'      => null,
        'location' => null,
        'country'  => null,
    );

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
        $address = new $this->php_address_class;
        return $this->apply($address, $address_data);
    }


    /**
     * @param  AddressProviderInterface $address_provider
     * @param  array|null               $address_data
     * @return AddressProviderInterface
     */
    public function apply(AddressProviderInterface $address_provider, array $address_data = null): AddressProviderInterface
    {
        $address = $address_provider->getAddress();

        if (!$address and $address_provider instanceOf AddressAwareInterface):
            $address = new $this->php_address_class;
            $address_provider->setAddress($address);
        endif;

        $raw = array_merge($this->default_data, $address_data ?: array());

        $address->setStreet1(   $raw['street1'])
                 ->setStreet2(  $raw['street2'])
                 ->setZip(      $raw['zip'])
                 ->setLocation( $raw['location'])
                 ->setCountry(  $raw['country'])
                 ->setType(     $raw['type']);



        return $address_provider;
    }
}
