<?php
namespace controllers;

use \application\Controller;
use \models\Category;
use \application\QueryRegistry;

class CategoryController extends Controller
{
	public function actionALl($params)
	{
		$categories = new Category;
		$categories->query("SELECT parent_category.child_id as child_id,
		 						   parent_category.parent_id as parent_id,
		 						   categories.name as name
							FROM parent_category
							LEFT JOIN categories
							ON parent_category.child_id = categories.category_id");

		$categories = $categories->execute();

		$dataset = [];
		foreach ($categories as $category) {
			$dataset[$category['child_id']] = $category;
		}

		$tree = [];

		foreach ($dataset as $id => &$node) { 
			if (!isset($dataset[$id]['parent_id'])){
				$tree[$id] = &$node;
			}else{ 
	            $dataset[$node['parent_id']]['children'][$id] = &$node;
			}
		}
		$tree = $tree[0]['children'];

		return $this->render('categories', 'main', ['categories' => $tree]); 
	}

	public function actionAdd($params)
	{
		$category = new Category;
		$category->query("INSERT INTO categories 
									(`name`)
								  VALUES ('{$params['category_name']}');");

		$category->execute();

		$category->query(" INSERT INTO parent_category 
									(`child_id`, `parent_id`)
								  VALUES ('{$category->getLastInsertedId()}',
								  		  '{$params['parent_id']}'); ");
		$category->execute();
		
		return $this->actionAll(null);
	} 

	public function actionDelete($params)
	{
		var_dump($params);
	}

	public function actionUpdate($params)
	{
		var_dump($params);
	}
}