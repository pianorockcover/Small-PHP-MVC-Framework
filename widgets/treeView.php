<?php
namespace widgets;

use \application\Widget;

class TreeView implements Widget
{
	public function widget(...$params)
	{
		echo $cat_menu = $this->showCat($params[0]);
	}

	private function tpl($category){
		$item = '<ul><li>'
				.'<form class="form" action="index.php" method="get">'
				.'<input  type="hidden" name="r" value="category/update">'
				."<input type='hidden' name='category_id' value='{$category['child_id']}'>"
				."<input class='input' type='text' name='category_name' value='{$category['name']}'>"
				.'<button class="btn btn-primary" type="submit">Редактировать</button>'
				."<a class='btn btn-danger' href='index.php?r=category/delete&category_id={$category['child_id']}'>Удалить</a>"
				.'</form>'
				.'</li>';
			
			if(isset($category['children'])){
				$item .= '<li>'. $this->showCat($category['children']) .'</li>';
			}
		$item .= '<form class="form" action="index.php" method="get">'
			  	 .'<li>'
			  	 .'<input  type="hidden" name="r" value="category/add">'
			  	 .'<input  type="hidden" name="parent_id" value="'.$category['parent_id'].'">'
					 .'<input class="input" type="text" name="category_name" placeholder="Введите категорию">'
					 ."<button class='btn btn-default' type='submit'>Добавить</button>"
				 .'</li>'
			  .'</form>';
		$item .= '</ul>';
		return $item;
	}

	private function showCat($data){
		$string = '';
		foreach($data as $item){
			$string .= $this->tpl($item);
		}

		return $string;
	}
}