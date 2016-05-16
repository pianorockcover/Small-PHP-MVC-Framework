<?php
namespace application;

class ConfigRegistry extends Registry
{
	protected $dbName;
	protected static $instance;

	protected function __construct($cashe) 
	{ 
		$this->dbName = $cashe['db']['name'];
	}

	public function getDBName()
	{
		return $this->dbName;
	}
}