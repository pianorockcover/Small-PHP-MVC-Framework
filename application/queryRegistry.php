<?php
namespace application;

class QueryRegistry extends Registry
{
	private $query;
	protected static $instance;

	protected function __construct($cashe) 
	{ 
		$this->query= $cashe;
	}

	public function getQuery()
	{
		return $this->query;
	}
}