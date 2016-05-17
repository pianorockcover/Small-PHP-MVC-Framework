<?php
namespace application;

abstract class DataMapper
{
	private $query;
	private $mysqli;
	private $dbConfiguration;

	abstract public function table();

	public function __construct()
	{
		$dbConfiguration = ConfigRegistry::getInstance()->getDBConfiguration();
		$mysqli = new mysqli($dbConfiguration['host'], 
							$dbConfiguration['user'],
							$dbConfiguration['password'],
							$dbConfiguration['name'],);
	}

	public function query($query)
	{
		$this->query = $query;
	}

	public function execute()
	{
		$this->mysqli = $mysqli->query($this->query);

		$results = [];
		while ($row = $query->fetch_assoc()) {
			array_push($results, $row);
		} 

		return $results;
	}

	public function __destruct()
	{
		$this->mysqli->close();
	}
}