<?php
namespace widgets;

use \application\Widget;
use \application\DataMapper;

class Pagination implements Widget
{
	private $limit;
	private $offset;
	private $amountOfRecords;
	private $amountOfPages; 
	private $currentPage;

	public function __construct($limit, $offset, DataMapper $model)
	{
		$this->offset = $offset;
		if (!isset($offset))
		{
			$this->offset = 0;
		}
		$this->amountOfRecords = $model->amountOfRecords();
		$this->limit = $limit;
		$this->currentPage = ceil($this->offset / $this->limit) + 1;
		$this->amountOfPages = ceil($this->amountOfRecords / $this->limit);
	}

	public function limit()
	{
		return $this->$limit;
	}

	public function offset()
	{
		return $this->offset;
	}

	public function widget(...$params)
	{
		var_dump($this->currentPage);
		var_dump($this->amountOfPages);
	}
}