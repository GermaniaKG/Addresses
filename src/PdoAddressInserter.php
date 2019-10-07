<?php
namespace Germania\Addresses;

class PdoAddressInserter
{
	/**
	 * @var PDOStmt
	 */
	public $stmt; 

	/**
	 * @var PDO
	 */
	public $pdo; 


	/**
	 * @param \PDO                $pdo
	 * @param string              $table_name
	 */
	public function __construct( \PDO $pdo, string $table_name )
	{
		$this->pdo = $pdo;

		$sql = "INSERT INTO {$table_name} 
		( type, street1, street2, zip, location, country )
		VALUES( :type, :street1, :street2, :zip, :location, :country)";

		$this->stmt = $pdo->prepare( $sql );
	}



	public function __invoke( AddressInterface $address ) : int
	{
		$result = $this->stmt->execute([
			'type'     => $address->getType(),
			'street1'  => $address->getStreet1(),
			'street2'  => $address->getStreet2(),
			'zip'      => $address->getZip(),
			'location' => $address->getLocation(),
			'country'  => $address->getCountry()
		]);

		if (!$result) {
			$msg = sprintf("Could not execute PDOStatement for inserting address");
			throw new \RuntimeException($msg);
		}

		return $this->pdo->lastInsertId();
	}
}