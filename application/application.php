<?php
namespace application;

class Application
{
	private $router;

	function __construct($config)
	{
		# Проверить запрос на ниличие инъекций
		# Проверить запрос на соответствие шаблону

		ConfigRegistry::init($config);
		QueryRegistry::init($_SERVER['REQUEST_URI']);

		return;
	}

	public function run()
	{
		$this->router = new Router(QueryRegistry::getInstance()->getQuery());
		
		$controller = $this->router->getController();
		$action = $this->router->getAction();
		$params = $this->router->getParams();

		echo $controller->$action($params);

		return;
	}
}