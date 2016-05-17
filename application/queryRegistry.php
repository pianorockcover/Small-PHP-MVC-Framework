<?php
namespace application;

class QueryRegistry extends Registry
{
	private $get;
	private $post;
	protected static $instance;

	protected function __construct($cashe) 
	{ 
		$this->get = $cashe['get'];
		$this->post = $cashe['post'];
	}

	public function getParams()
	{
		if (!$this->post)
		{
			return $this->get;
		}

		return $this->post;
	}
}