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

		// $categories->query("SELECT parent_id, group_concat(child_id) as children_ids
		// 					FROM parent_category
		// 					GROUP BY parent_id");

		$categories->query("SELECT *
							FROM parent_category");
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
	            $dataset[$node['parent_id']]['childs_ids'][$id] = &$node;
			}
		}

		return $this->render('categories', 'main', ['categories' => $tree]); 
	}
}