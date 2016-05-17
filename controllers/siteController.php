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

		$news->query("SELECT news.news_id,
							 news.date,
							 news.title,
							 news.summary,
							 news.content,
							 categories.name as category
		 			  FROM {$news->table()}
					  JOIN categories 
					  ON {$news->table()}.category_id = categories.category_id");

		$pagination = new Pagination(11, $params['offset'], $news);
		$news->extendQuery(" WHERE {$news->table()}_id > {$pagination->offset()} 
							 LIMIT 10");
		
		$news = $news->execute();

		return $this->render('index','main', ['title' => 'All News',
											  'news' => $news,
											  'pagination' => $pagination]);
	}
}