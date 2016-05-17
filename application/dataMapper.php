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

	public function getLastInsertedID()
	{
		return $this->mysqli->insert_id;
	}

	public function execute()
	{
		$query = $this->mysqli->query($this->query);

		if (!is_bool($query)) 
		{
			$results = [];
			while ($row = $query->fetch_assoc()) {
				array_push($results, $row);
			} 

			return $results;
		}

		return $this->query;
	}

	public function __destruct()
	{
		$this->mysqli->close();
	}
}