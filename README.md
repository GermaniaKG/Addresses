<img src="https://static.germania-kg.com/logos/ga-logo-2016-web.svgz" width="250px">

------



# Germania KG · Addresses


[![Packagist](https://img.shields.io/packagist/v/germania-kg/addresses.svg?style=flat)](https://packagist.org/packages/germania-kg/addresses)
[![PHP version](https://img.shields.io/packagist/php-v/germania-kg/addresses.svg)](https://packagist.org/packages/germania-kg/addresses)
[![Build Status](https://img.shields.io/travis/GermaniaKG/Addresses.svg?label=Travis%20CI)](https://travis-ci.org/GermaniaKG/Addresses)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GermaniaKG/Addresses/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Addresses/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/GermaniaKG/Addresses/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Addresses/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/GermaniaKG/Addresses/badges/build.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Addresses/build-status/master)



## Installation

```bash
$ composer require germania-kg/addresses
```



## Usage

### AddressInterface and Address Class

The **AddressInterface** provides 5 basic methods as follows, with the **Address** being its basic implementation:

```php
<?php
use Germania\Address;

$address = new Address;

// All these are string or null
echo $address->getStreet1();
echo $address->getStreet2();
echo $address->getZip();
echo $address->getLocation();
echo $address->getCountry();
echo $address->getType();

// Depending on street1/street2, zip, and location
echo $address->isEmpty() ? "empty" : "has address data";

// Setters accept string or null,
// returning fluent interface.
$address->setStreet1( $new_street_1 )
  ->setStreet2( $new_street_2 )
  ->setZip( $new_zip ) 
  ->setLocation( $new_location )
  ->setsetCountry( $new_country )
  ->setType( $new_type );
```

The **Adress** class also implements the **AddressProviderInterface**, returning itself:

```php
$adr2 = $address->getAddress();
$adr2 === $address; // true
```



### Create using a factory

The **AddressFactory** class is callable and accepts associative arrays.

```php
<?php
use Germania\Address;

$factory = new AddressFactory;
$address = $factory([
  'type'     => 'office',
  'street1'  => 'Street name 1',
  'street2'  => null,
  'zip'      => 'DG2JQ',
  'location' => 'Dumfries',
  'country'  => 'Scotland'
]);
```

The factory creates per default **Address** instances; the concrete class used can be configured via constructor setting:

```php
// Given a custom implementation
// and $address_data from database
class CustomAddress extends Address {}

$address_data = array( ... );

$factory = new AddressFactory( CustomAddress::class );
$address = $factory( $address_data );

echo get_class( $address ); // CustomAddress
```

### Update Addess instances using the factory

The factory also has an **apply** method that aims at *AddressProviderInterface* instances. It will apply the information given with the array parameter:

```php
<?php
use Germania\Address\AddressFactory;
use Germania\Address\AddressProviderInterface;
use Germania\Address\Address;

// Custom AddressProviderInterface implementation
class MyAddressProvider implements AddressProviderInterface
{ };

$address_provider = new MyAddressProvider;
$factory = new AddressFactory;

$address_provider = $factory->apply($provider_address, [
	'street1' => 'Updated information'
]);
```

Remember, class *Address* also implements *AddressProviderInterface*!

```php
$old_address = new Address;
$new_address = factory->apply(old_address, new_address_data);
echo get_class( $new_address ); // Address
```



### Getting and Setting an Address object

The interface **AddressProviderInterface** provides a ***getAddress*** method. The trait **AddressProviderTrait** provides an implementation:

```php
<?php
use Germania\AddressProviderInterface;
use Germania\AddressProviderTrait;

class MyClass implements AddressProviderInterface
{
  use AddressProviderTrait;
}

$obj = new MyClass;
$address = $obj->getAddress();
```

The **AddressAwareInterface** extends *AddressProviderInterface* and additionally provides a **setAdress** method. The **AddressAwareTrait** provides an implementation, using the *AddressProviderTrait.*

```php
<?php
use Germania\Address;
use Germania\AddressAwareInterface;
use Germania\AddressAwareTrait;  

class MyClass implements AddressProviderInterface
{
  use AddressAwareTrait;
}

$obj = new MyClass;
$address = $obj->getAddress();
// null

$obj->setAddress( new Address );
print_r( $obj->getAddress() );
// Germania\Address
```


## Issues

See [full issues list.][i0]

[i0]: https://github.com/GermaniaKG/Addresses/issues

## Roadmap
Fill in planned or desired features


## Development

```bash
$ git clone https://github.com/GermaniaKG/Addresses.git
$ cd Addresses
$ composer install
```

## Unit tests

Either copy `phpunit.xml.dist` to `phpunit.xml` and adapt to your needs, or leave as is. Run [PhpUnit](https://phpunit.de/) test or composer scripts like this:

```bash
$ composer test
# or
$ vendor/bin/phpunit
```

