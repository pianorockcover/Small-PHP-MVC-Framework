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

		return;
	}

	public function run()
	{
		try {
			$this->router = new Router(QueryRegistry::getInstance()->getQuery());
			$controller = $this->router->getController();
			$action = $this->router->getAction();
			$params = $this->router->getParams();

			echo $controller->$action($params);
		} catch (\Exception $e) {
			echo $e->getMessage();
		}

		return;
	}
}