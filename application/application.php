<?php
namespace application;

class Application
{
	private $router;

	function __construct($config)
	{
		#... Создать реестр для config
		#... Создать реестр для query
	}

	public function run()
	{
		$this->router = new Router($query);
		$controller = $router->getController();
		$action = $action->getAction();
		$controller->$action();

		return;
	}
}