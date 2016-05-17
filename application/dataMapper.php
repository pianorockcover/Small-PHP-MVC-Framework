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
		
		$this->mysqli = new \mysqli($dbConfiguration['host'], 
							$dbConfiguration['user'],
							$dbConfiguration['password'],
							$dbConfiguration['name']);
		$this->mysqli->set_charset('utf8');
	}

	public function query($query)
	{
		$this->query = $query;
	}

	public function extendQuery($query)
	{
		$this->query .= $query;
	}

	public function amountOfRecords()
	{
		$rows = $this->mysqli->query($this->query);
		return $rows->num_rows;	
	}

	public function execute()
	{
		$this->query = $this->mysqli->query($this->query);

		$results = [];
		while ($row = $this->query->fetch_assoc()) {
			array_push($results, $row);
		} 

		return $results;
	}

	public function __destruct()
	{
		$this->mysqli->close();
	}
}