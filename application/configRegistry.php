<?php
namespace application;

class ConfigRegistry extends Registry
{
	protected static $instance;
	protected $db;
	protected $web;
	
	protected function __construct($cashe) 
	{ 
		$this->db = $cashe['db'];
		$this->web = $cashe['web'];
	}

	public function getDBConfiguration()
	{
		return $this->db;
	}

	public function getWebConfiguration()
	{
		return $this->web;
	}
}