<?php
namespace Germania\Addresses;

trait AddressesAwareTrait
{
	use AddressesProviderTrait;


	/**
	 * @inheritDoc
	 */
	public function setAddresses(iterable $addresses) : self
	{

		if ($addresses instanceOf AddressesCollectionInterface):
			$this->addresses = $addresses;
		
		elseif (is_array($addresses)):
			$this->addresses = new AddressesCollection( $addresses );

		elseif ($addresses instanceOf \Traversable):
			$this->addresses = new AddressesCollection( iterator_to_array($addresses ));			

		else:
			throw new \InvalidArgumentException( "AddressesCollectionInterface or Array or Traversable expected"); 

		endif; 

		return $this;
	}
}