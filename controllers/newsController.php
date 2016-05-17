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
					  LEFT JOIN categories 
					  ON {$news->table()}.category_id = categories.category_id");

		$pagination = new Pagination(10, $params['offset'], $news);
		$news->extendQuery(" WHERE {$news->table()}_id > {$pagination->offset()} 
							 LIMIT 10");
		
		$news = $news->execute();

		return $this->render('index','main', ['title' => 'All News',
											  'news' => $news,
											  'pagination' => $pagination]);
	}
	
	public function actionEdit($params)
	{
		$id = $params['news_id'];

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
		
		# Защита от SQL инъекций
		foreach ($params as $key => $param) {
			$params[$key] = str_replace('\'', '`', $params[$key]);
			$params[$key] = str_replace('"', '`', $params[$key]);
		}

		$news = new News;
		$news->query("UPDATE {$news->table()} 
								  SET news.title = '{$params['title']}',
								  		news.date = '{$params['date']}',
								  		news.summary = '{$params['summary']}',
								  		news.content = '{$params['content']}'
								  WHERE news_id ='{$params['news_id']}'");
		$news->execute();
		return $this->actionAll(['offset' => 0]);
	}

	public function actionDelete($params)
	{
		$news = new News;
		$news->query("DELETE FROM {$news->table()} 
								  WHERE news.news_id = {$params['news_id']}");
		$news->execute();

		return $this->actionAll(['offset' => 0]);
	}

	public function actionAdd($params)
	{
		return $this->render('add','main');
	}

	public function actionInsert($params)
	{
		# Защита от SQL инъекций
		foreach ($params as $key => $param) {
			$params[$key] = str_replace('\'', '`', $params[$key]);
			$params[$key] = str_replace('"', '`', $params[$key]);
		}

		$news = new News;
		$news->query("INSERT INTO {$news->table()} 
									(`title`, `date`, `summary`, `content`)
								  VALUES ('{$params['title']}',
								  		    '{$params['date']}',
								  		    '{$params['summary']}',
								  		    '{$params['content']}')");
		$news->execute();

		$image = QueryRegistry::getInstance()->getFiles()['image'];

		if (strpos($image['type'], 'image/') !== false)
		{
			file_put_contents("assets/images/{$news->getLastInsertedId()}.jpg", file_get_contents($image['tmp_name']));
		}

		return $this->actionAll(['offset' => 0]);
	}

	public function actionFUllView()
	{
		
	}

}