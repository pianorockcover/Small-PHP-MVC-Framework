<?php
namespace application;

class Application
{
	private $router;

	function __construct($config)
	{
		# Проверить запрос на ниличие инъекций

		ConfigRegistry::init($config);
		QueryRegistry::init($_SERVER['REQUEST_URI']);

		exit();
		
		return;
	}

	public function run()
	{
		$this->router = new Router();
		$controller = $router->getController();
		$action = $action->getAction();
		$controller->$action();

		return;
	}
}