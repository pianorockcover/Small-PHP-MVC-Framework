<?php
namespace controllers;

use \application\Controller;
use \models\News;
use \widgets\Pagination;

class SiteController extends Controller
{
	function actionIndex($params)
	{
		#... Вытаскиваем новости из базы
		$news = new News;

		$news->query("SELECT * FROM {$news->table()}");

		$pagination = new Pagination(11, $params['offset'], $news);
		$news->extendQuery(" WHERE {$news->table()}_id > {$params['offset']} LIMIT 10");
		
		$news = $news->execute();

		return $this->render('index','main', ['title' => 'All News',
											  'news' => $news,
											  'pagination' => $pagination]);
	}
}