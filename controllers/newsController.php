<?php
namespace controllers;

use \application\Controller;
use \models\News;
use \models\Category;
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
							 ORDER BY news_id ASC
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
							 categories.name as category_name,
							 categories.category_id as category_id
		 			  FROM {$news->table()}
					  LEFT JOIN categories 
					  ON {$news->table()}.category_id = categories.category_id
					  WHERE news_id = {$id}");

		$news = $news->execute()[0];

		$categories = new Category;
		$categories->query("SELECT *
							FROM categories");
		$categories = $categories->execute();

		foreach ($categories as $key => $category) {
			if ($news['category_id'] === $category['category_id'])
			{
				$categories[$key]['isSelected'] = 'selected';
			}
		}

		return $this->render('edit', 'main', [
				 'title' => $news['title'],
				 'news' => $news,
				 'categories' => $categories,
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
								  		news.content = '{$params['content']}',
								  		news.category_id = '{$params['category']}'
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
		unlink("assets/images/{$params['news_id']}.jpg");

		return $this->actionAll(['offset' => 0]);
	}

	public function actionAdd($params)
	{
		$categories = new Category;
		$categories->query("SELECT *
							FROM categories");
		$categories = $categories->execute();

		return $this->render('add','main', ['categories' => $categories]);
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
									(`title`, `date`, `summary`, `content`, `category_id`)
								  VALUES ('{$params['title']}',
								  		    '{$params['date']}',
								  		    '{$params['summary']}',
								  		    '{$params['content']}',
								  		    '{$params['category']}')");
		$news->execute();

		$image = QueryRegistry::getInstance()->getFiles()['image'];

		if (strpos($image['type'], 'image/') !== false)
		{
			file_put_contents("assets/images/{$news->getLastInsertedId()}.jpg", file_get_contents($image['tmp_name']));
		}

		return $this->actionAll(['offset' => 0]);
	}

	public function actionFullView($params)
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
					  LEFT JOIN categories 
					  ON {$news->table()}.category_id = categories.category_id
					  WHERE news_id = {$id}");

		$news = $news->execute()[0];

		return $this->render('full-view', 'main', [
				 'title' => $news['title'],
				 'news' => $news,
			]);
	}

}