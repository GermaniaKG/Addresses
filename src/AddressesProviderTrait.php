<?php
namespace Germania\Addresses;

trait AddressesProviderTrait
{

	/**
	 * @var AddressesCollectionInterface
	 */
	public $addresses = array();


	/**
	 * @inheritDoc
	 */
	public function getAddresses() : AddressesCollectionInterface
	{
		if ($this->addresses instanceOf AddressesCollectionInterface):
			return $this->addresses;
		
		elseif (is_array($this->addresses)):
			$this->addresses = new AddressesCollection( $this->addresses );

		elseif ($this->addresses instanceOf \Traversable):
			$this->addresses = new AddressesCollection( iterator_to_array($this->addresses ));			

		elseif (empty($this->addresses)):
			$this->addresses = new AddressesCollection;			

		else:
			throw new \UnexpectedValueException( "AddressesCollectionInterface or Array or Traversable expected"); 

		endif; 

		return $this->addresses;
	}
}