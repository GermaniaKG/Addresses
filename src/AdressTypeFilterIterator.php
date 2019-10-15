<?php
namespace Germania\Addresses;


class AdressTypeFilterIterator extends \FilterIterator implements \Countable 
{

	/**
	 * The allowed address type
	 * @var string
	 */
	public $address_type;

	/**
	 * Wether to use the address type as regex
	 * @var boolean
	 */
	public $use_regex = false;


	/**
	 * @param \Traversable $iterator
	 * @param string       $address_type
	 * @param bool|boolean $use_regex
	 */
    public function __construct(\Traversable $iterator, string $address_type, bool $use_regex = false)
    {
        parent::__construct( new \IteratorIterator($iterator));
        $this->address_type = $address_type;
        $this->use_regex = $use_regex;
    }


    public function accept()
    {
        $current = $this->getInnerIterator()->current();

        if ($current instanceOf AddressInterface ):
        	if (!$this->use_regex):
        		return ($current->getType() == $this->address_type);
        	endif;

        	return preg_match($this->address_type, $current->getType());

        endif;

        return false;
    }


    public function count()
    {
        return iterator_count($this);
    }		
}