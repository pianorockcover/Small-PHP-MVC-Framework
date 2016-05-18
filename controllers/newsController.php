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

		$amountOfRecords = $news->amountOfRecords();
		$offset = abs($amountOfRecords - $params['offset']) + 1;

		$pagination = new Pagination(10, $params['offset'], $news);
		$news->extendQuery(" WHERE news_id < $offset
							 ORDER BY news_id DESC
							 LIMIT 10");
		$news = $news->execute();

		return $this->render('index','main', ['title' => 'Все новости',
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
		return $this->actionFullView(['news_id' => $params['news_id']]);
	}

	public function actionDelete($params)
	{
		$news = new News;
		$news->query("DELETE FROM {$news->table()} 
								  WHERE news.news_id = {$params['news_id']}");
		$news->execute();

		if(file_exists("assets/images/{$params['news_id']}.jpg"))
		{
			unlink("assets/images/{$params['news_id']}.jpg");
		}

		$news->query("SELECT * FROM news; ");
		$amountOfRecords = $news->amountOfRecords();

		for ($i = $params['news_id']; $i <= $amountOfRecords; $i++) { 
			$next = $i + 1;
			$news->query("UPDATE news
								SET news.news_id = {$i}
									WHERE news.news_id = {$next}; ");

			$news->execute();
			
			if (file_exists("assets/images/{$next}.jpg"))
			rename("assets/images/{$next}.jpg", "assets/images/{$i}.jpg");
		}

		return $this->actionAll(['offset' => 0]);
	}

	public function actionAdd($params)
	{
		$categories = new Category;
		$categories->query("SELECT *
							FROM categories");
		$categories = $categories->execute();

		return $this->render('add','main', [
				'title' => 'Добавить новость',
				'categories' => $categories,
			]);
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

		return $this->actionFullView(['news_id' => $news->getLastInsertedId()]);

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