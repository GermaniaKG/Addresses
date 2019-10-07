<?php
namespace Germania\Addresses;

class PdoAddressUpdater
{
	/**
	 * @var PDOStmt
	 */
	public $stmt; 


	/**
	 * @param \PDO                $pdo
	 * @param string              $table_name
	 */
	public function __construct( \PDO $pdo, string $table_name )
	{

		$sql = "UPDATE {$table_name} 
		SET
		type     = :type,
		street1  = :street1,
		street2  = :street2,
		zip      = :zip,
		location = :location,
		country  = :country
		WHERE id = :id
		LIMIT 1";

		$this->stmt = $pdo->prepare( $sql );
	}



	public function __invoke( PdoAddressInterface $address ) : int
	{
		if (!$id = $address->getId())
			throw new \UnexpectedValueException("Addess object 'getId' did not return primary key value");

		$result = $this->stmt->execute([
			'id'       => $id,
			'type'     => $address->getType(),
			'street1'  => $address->getStreet1(),
			'street2'  => $address->getStreet2(),
			'zip'      => $address->getZip(),
			'location' => $address->getLocation(),
			'country'  => $address->getCountry()
		]);

		if (!$result) {
			$msg = sprintf("Could not execute PDOStatement for address ID '%s'", $id);
			throw new \RuntimeException($msg);
		}

		return $this->stmt->rowCount();
	}
}