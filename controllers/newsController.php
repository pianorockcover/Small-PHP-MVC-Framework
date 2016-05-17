<?php
namespace controllers;

use \application\Controller;
use \models\News;
use \widgets\Pagination;
use \application\QueryRegistry;

class NewsController extends Controller
{
	function actionAll($params)
	{
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
	
	public function actionEdit($params)
	{
		$id = $params['id'];

		$news = new News;

		$news->query("SELECT news.news_id,
							 news.date,
							 news.title,
							 news.summary,
							 news.content,
							 categories.name as category
		 			  FROM {$news->table()}
					  JOIN categories 
					  ON {$news->table()}.category_id = categories.category_id
					  WHERE news_id = {$id}");

		$news = $news->execute()[0];

		return $this->render('edit', 'main', [
				 'title' => $news['title'],
				 'news' => $news,
			]);
	}

	public function actionUpdate($params)
	{
		$image = QueryRegistry::getInstance()->getFiles()['image'];

		if (strpos($image['type'], 'image/') !== false)
		{
			file_put_contents("assets/images/{$params['news_id']}.jpg", file_get_contents($image['tmp_name']));
		}
		
		$news = new News;

		$news->query();

		return $this->actionAll(['offset' => 0]);
	}

	public function actionDelete($params)
	{
		$id = $params['id'];	
	}

	public function actionAdd($params)
	{
		
	}

}