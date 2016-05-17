<?php
namespace application;

class Router
{
	private $controller;
	private $action;
	private $actionParams;

	function __construct($params)
	{
		$this->controller = ConfigRegistry::getInstance()->getWebConfiguration()['defaultController'];
		$this->action = ConfigRegistry::getInstance()->getWebConfiguration()['defaultAction'];
		$this->actionParams = NULL;


		# Парсим запросы типа: ?r=controler/action&param1=value&param2=value...
		if(!isset($params['r']))
		{
			return;
		}
		
		$actionAndController = $params['r'];
		$this->controller = ucfirst(substr($actionAndController, 0, strpos($actionAndController, '/'))).'Controller';	
		$this->action = 'action'.ucfirst(substr($actionAndController, strpos($actionAndController, '/') + 1, strlen($actionAndController)));	

		if(count($params) > 1)
		{
			unset($params['r']);
			$this->actionParams = $params; 
		}

		return;
	}

	public function getController()
	{
		$controller = "\controllers\\{$this->controller}";
		if (!class_exists($controller, true))
		{
			throw new \Exception("Bad Request 404", 404);
		}
		return new $controller;
	}

	public function getAction()
	{
		return $this->action;
	}

	public function getParams()
	{
		return $this->actionParams;
	}
}
