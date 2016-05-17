<?php
namespace application;

class Application
{
	private $router;

	function __construct($config)
	{
		# Проверить запрос на ниличие инъекций

		ConfigRegistry::init($config);
		QueryRegistry::init(['get' => $_GET, 'post' => $_POST, 'files' => $_FILES]);

		return;
	}

	public function run()
	{
		try {
			$this->router = new Router(QueryRegistry::getInstance()->getParams());
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