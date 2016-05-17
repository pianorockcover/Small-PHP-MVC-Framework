<?php
namespace controllers;

use \application\Controller;
use \models\News;

class SiteController extends Controller
{
	function actionIndex(...$params)
	{
		#... Вытаскиваем новости из базы
		$news = new News;
		$news->query("SELECT * FROM {$news->table()}");

		$news = $news->execute();

		return $this->render('index','main', ['title' => 'All News',
											  'news' => $news,]);
	}
}