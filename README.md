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



## Interfaces and Traits

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
```

The **Adress** class also implements the **AddressProviderInterface**, returning itself:

```php
$adr2 = $address->getAddress();
$adr2 === $address; // true
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

