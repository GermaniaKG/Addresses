# Germania KG · Addresses



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



## Development and testing

```bash
$ composer test
```

