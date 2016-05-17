<?php
namespace controllers;

use \application\Controller;

class SiteController extends Controller
{
	function actionIndex(...$params)
	{
		#... Вытаскиваем новости из базы
		return $this->render('index','main', ['title'=> 'Simple Engine',
											  'text' => 'Hello Wordl']);
	}
}