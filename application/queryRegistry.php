<?php
namespace application;

class QueryRegistry extends Registry
{
	private $get;
	private $post;
	private $files;
	protected static $instance;

	protected function __construct($cashe) 
	{ 
		$this->get = $cashe['get'];
		$this->post = $cashe['post'];
		$this->files = $cashe['files'];
	}

	public function getParams()
	{
		if (!$this->post)
		{
			return $this->get;
		}

		return $this->post;
	}

	public function getFiles()
	{
		return $this->files;
	}
}