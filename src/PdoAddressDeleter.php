<?php
namespace Germania\Addresses;

class PdoAddressDeleter
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

		$sql = "DELETE FROM {$table_name} 
		WHERE id = :id
		LIMIT 1";

		$this->stmt = $pdo->prepare( $sql );
	}



	public function __invoke( PdoAddressInterface $address ) : int
	{
		if (!$id = $address->getId())
			throw new \UnexpectedValueException("Addess object 'getId' did not return primary key value");

		$result = $this->stmt->execute([
			'id'       => $id
		]);

		if (!$result) {
			$msg = sprintf("Could not execute PDOStatement for address ID '%s'", $id);
			throw new \RuntimeException($msg);
		}

		return $this->stmt->rowCount();
	}
}