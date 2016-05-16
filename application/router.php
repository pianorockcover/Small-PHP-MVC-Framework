<?php
namespace application;

class Router
{
	private $controller;
	private $action;

	function __construct($query)
	{
		$this->controller = 'site';
		$this->action = 'index';
		echo $query;

		return;
		#Проверка url
		#Parse Query;
	}
}