<?php
namespace Germania\Addresses;

class PdoAddressFactory
{
	/**
	 * @var AddressFactory
	 */
	public $address_factory; 	

	/**
	 * @var PDOStmt
	 */
	public $stmt; 

	public static $DB_FIELDS = array(
		'id',
		'type',
		'street1',
		'street2',
		'zip',
		'location',
		'country'
	);

	/**
	 * @param \PDO                $pdo
	 * @param string              $table_name
	 * @param AddressFactory|null $address_factory
	 */
	public function __construct( \PDO $pdo, string $table_name, AddressFactory $address_factory = null )
	{
		$this->address_factory = $address_factory ?: new AddressFactory;

		$sql = "SELECT " . implode(",", static::$DB_FIELDS) ."
		FROM {$table_name}
		WHERE id = :id";

		$this->stmt = $pdo->prepare( $sql );
		$this->stmt->setFetchMode(\PDO::FETCH_CLASS, PdoAddress::class);
	}


	public function __invoke( int $id ) : AddressInterface
	{
		if (!$this->stmt->execute(['id' => $id]))
			throw new \RuntimeException("Could not execute SELECT Address PDOStatement");

		return $this->stmt->fetch();
	}
}